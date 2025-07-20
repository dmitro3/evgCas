<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { ref, onMounted, onUnmounted } from "vue";

const balls = ref(10);
const multiplier = ref(1);
const canvas = ref(null);
const lastResult = ref("Waiting...");
const isDropping = ref(false);
const rows = ref(16);
const showRowsDropdown = ref(false);
const betAmount = ref(1.00);
const soundEnabled = ref(true);

const rowsOptions = [8, 9, 10, 11, 12, 13, 14, 15, 16];

let engine, render, pegs, pegAnims, notes, autoDroppingInterval;
let clickSynth;
let currentBallRadius = 7;
let currentGAP = 32;

const getMultipliers = (numRows) => {
    const multiplierMaps = {
        8: [5.6, 2.1, 1.1, 1, 0.5, 1, 1.1, 2.1, 5.6],
        9: [5.6, 2, 1.6, 1, 0.7, 0.7, 1, 1.6, 2, 5.6],
        10: [8.9, 3, 1.4, 1.1, 1, 0.5, 1, 1.1, 1.4, 3, 8.9],
        11: [8.4, 3, 1.9, 1.3, 1, 0.7, 0.7, 1, 1.3, 1.9, 3, 8.4],
        12: [10, 3, 1.6, 1.4, 1.1, 1, 0.5, 1, 1.1, 1.4, 1.6, 3, 10],
        13: [8.1, 4, 3, 1.9, 1.2, 0.9, 0.7, 0.7, 0.9, 1.2, 1.9, 3, 4, 8.1],
        14: [7.1, 4, 1.9, 1.4, 1.3, 1.1, 1, 0.5, 1, 1.1, 1.3, 1.4, 1.9, 4, 7.1],
        15: [15, 8, 3, 2, 1.5, 1.1, 1, 0.7, 0.7, 1, 1.1, 1.5, 2, 3, 8, 15],
        16: [16, 9, 2, 1.4, 1.4, 1.2, 1.1, 1, 0.5, 1, 1.1, 1.2, 1.4, 1.4, 2, 9, 16]
    };
    return multiplierMaps[numRows] || multiplierMaps[16];
};

onMounted(() => {
    loadLibrariesAndInit();

    document.addEventListener('click', handleOutsideClick);
});

function loadLibrariesAndInit() {
    const loadScript = (src) => {
        return new Promise((resolve, reject) => {
            const script = document.createElement("script");
            script.src = src;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    };

    const loadFont = () => {
        const link = document.createElement("link");
        link.href =
            "https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap";
        link.rel = "stylesheet";
        document.head.appendChild(link);
    };

    loadFont();

    Promise.all([
        loadScript(
            "https://cdnjs.cloudflare.com/ajax/libs/matter-js/0.19.0/matter.min.js"
        ),
        loadScript(
            "https://cdnjs.cloudflare.com/ajax/libs/tone/14.8.49/Tone.js"
        ),
    ])
        .then(() => {
            initializePlinko();
        })
        .catch((error) => {
            console.error("Ошибка загрузки библиотек:", error);
        });
}

onUnmounted(() => {
    if (autoDroppingInterval) {
        clearInterval(autoDroppingInterval);
    }

    document.removeEventListener('click', handleOutsideClick);
});

function initializePlinko() {
    const width = 620;
    const currentRows = rows.value;

    // Сначала вычисляем GAP для правильного расчета высоты
    const baseGap = 32;
    const gapMultiplier = Math.max(1, (16 - currentRows) * 0.06 + 1);
    const GAP = Math.round(baseGap * gapMultiplier);
    currentGAP = GAP;

    // Адаптируем высоту канваса в зависимости от количества рядов и GAP
    const baseHeight = 0;
    const height = baseHeight + (currentRows * GAP) + 10;

    // Адаптируем размер шариков - чем меньше рядов, тем больше шарики (но не слишком большие)
    const ballSizeMultiplier = Math.max(1, (16 - currentRows) * 0.1 + 1);
    const BALL_RAD = Math.round(7 * ballSizeMultiplier);
    currentBallRadius = BALL_RAD;

    console.log(`Количество рядов: ${currentRows}, GAP: ${GAP}, Высота: ${height}, Размер шарика: ${BALL_RAD}`);

    class Note {
        constructor(note) {
            this.note = note;
            this.synth = null;
        }

        initSynth() {
            if (!this.synth) {
                this.synth = new Tone.PolySynth().toDestination();
                this.synth.set({ volume: -6 });
            }
        }

        play() {
            this.initSynth();
            return this.synth.triggerAttackRelease(
                this.note,
                "32n",
                Tone.context.currentTime
            );
        }
    }

    notes = [
        "C#5",
        "C5",
        "B5",
        "A#5",
        "A5",
        "G#4",
        "G4",
        "F#4",
        "F4",
        "F#4",
        "G4",
        "G#4",
        "A5",
        "A#5",
        "B5",
        "C5",
        "C#5",
    ].map((note) => new Note(note));

    const Engine = Matter.Engine,
        Events = Matter.Events,
        Render = Matter.Render,
        Bodies = Matter.Bodies,
        Composite = Matter.Composite;

    engine = Engine.create({
        gravity: {
            scale: 0.0007,
        },
    });

    render = Render.create({
        canvas: canvas.value,
        engine,
        options: {
            width,
            height,
            wireframes: false,
        },
    });

    // Устанавливаем размеры канваса в DOM
    if (canvas.value) {
        canvas.value.style.height = height + 'px';
        canvas.value.style.width = width + 'px';
    }

    // Адаптируем размер препятствий
    const basePegRadius = 4;
    const pegMultiplier = Math.max(1, (16 - currentRows) * 0.08 + 1);
    const PEG_RAD = Math.round(basePegRadius * pegMultiplier);

    pegs = [];

    console.log(`GAP: ${GAP}, GAP multiplier: ${gapMultiplier}, PEG_RAD: ${PEG_RAD}`);

    for (let r = 0; r < currentRows; r++) {
        const pegsInRow = r + 3;
        for (let c = 0; c < pegsInRow; c++) {
            const x = width / 2 + (c - (pegsInRow - 1) / 2) * GAP;
            const y = GAP + r * GAP;
            const peg = Bodies.circle(x, y, PEG_RAD, {
                isStatic: true,
                label: "Peg",
                render: {
                    fillStyle: "#fff",
                },
            });
            pegs.push(peg);
        }
    }
    Composite.add(engine.world, pegs);

    pegAnims = new Array(pegs.length).fill(null);



    const ground = Bodies.rectangle(width / 2, height + 22, width * 2, 40, {
        isStatic: true,
        label: "Ground",
    });
    Composite.add(engine.world, [ground]);

    function checkCollision(event, label1, label2, callback) {
        event.pairs.forEach(({ bodyA, bodyB }) => {
            let body1, body2;
            if (bodyA.label === label1 && bodyB.label === label2) {
                body1 = bodyA;
                body2 = bodyB;
            } else if (bodyA.label === label2 && bodyB.label === label1) {
                body1 = bodyB;
                body2 = bodyA;
            }
            if (body1 && body2) {
                callback(body1, body2);
            }
        });
    }

    Matter.Events.on(engine, "collisionStart", (event) => {
                checkCollision(event, "Ball", "Ground", (ballToRemove) => {
            Matter.Composite.remove(engine.world, ballToRemove);

            const currentMultipliers = getMultipliers(currentRows);
            const numBuckets = currentMultipliers.length;
            const leftEdge = width / 2 - ((numBuckets - 1) / 2) * currentGAP;
            const index = Math.floor(
                (ballToRemove.position.x - leftEdge) / currentGAP
            );
            const clampedIndex = Math.max(0, Math.min(numBuckets - 1, index));

            console.log(
                `Позиция шарика: ${ballToRemove.position.x}, Индекс: ${index}, Ограниченный индекс: ${clampedIndex}, Множитель: ${currentMultipliers[clampedIndex]}`
            );

            if (clampedIndex >= 0 && clampedIndex < numBuckets) {
                const multiplierValue = currentMultipliers[clampedIndex];
                const ballsWon = multiplierValue > 0 ? Math.floor(multiplierValue) : 0;
                balls.value += ballsWon;

                lastResult.value = `${multiplierValue}x`;
                isDropping.value = false;

                recordPositionToDatabase(
                    ballToRemove.position.x,
                    clampedIndex,
                    multiplierValue,
                    currentRows
                );

                console.log(
                    `Корзина ${clampedIndex}, Множитель: ${multiplierValue}, Выиграно шариков: ${ballsWon}, Всего шариков: ${balls.value}`
                );

                const el = document.getElementById(`note-${clampedIndex}`);
                if (el && el.dataset.pressed !== "true") {
                    const note = notes[clampedIndex % notes.length];
                    if (soundEnabled.value) {
                        Tone.start().then(() => {
                            note.play();
                        });
                    }
                    el.dataset.pressed = true;
                    setTimeout(() => {
                        el.dataset.pressed = false;
                    }, 500);
                }

                setTimeout(() => {
                    lastResult.value = "Waiting...";
                    dropNextBall();
                }, 3000);
            }
        });

        checkCollision(event, "Peg", "Ball", (pegToAnimate) => {
            const index = pegs.findIndex((peg) => peg === pegToAnimate);
            if (index !== -1 && !pegAnims[index]) {
                pegAnims[index] = new Date().getTime();
            }
        });
    });

    Render.run(render);

    const ctx = canvas.value.getContext("2d");
    function run() {
        const now = new Date().getTime();

        pegAnims.forEach((anim, index) => {
            if (!anim) return;
            const delta = now - anim;
            if (delta > 1200) {
                pegAnims[index] = null;
                return;
            }
            const peg = pegs[index];
            if (!peg) return;
            const pct = delta / 1200;
            const expandProgression = 1 - Math.abs(pct * 2 - 1);
            const expandRadius = expandProgression * 12;
            ctx.fillStyle = "#fff2";
            ctx.beginPath();
            ctx.arc(
                peg.position.x,
                peg.position.y,
                expandRadius,
                0,
                2 * Math.PI
            );
            ctx.fill();
        });

        Engine.update(engine, 1000 / 60);
        requestAnimationFrame(run);
    }
    run();

    setTimeout(() => {
        dropNextBall();
    }, 2000);
}

async function recordPositionToDatabase(
    positionX,
    bucketIndex,
    multiplierValue,
    rowsCount
) {
    try {
        const response = await fetch("/api/plinko/record-position", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content") || "",
            },
            body: JSON.stringify({
                position_x: positionX,
                bucket_index: bucketIndex,
                multiplier: multiplierValue,
                rows: rowsCount,
            }),
        });

        const data = await response.json();
        console.log("Позиция записана в БД:", data);
    } catch (error) {
        console.error("Ошибка при записи в БД:", error);
    }
}

function dropNextBall() {
    if (!isDropping.value && balls.value > 0) {
        isDropping.value = true;
        lastResult.value = "Dropping...";
        dropABall();
    }
}

function setBetHalf() {
    betAmount.value = Math.max(0.01, betAmount.value / 2);
}

function setBetDouble() {
    betAmount.value = betAmount.value * 2;
}

function toggleSound() {
    soundEnabled.value = !soundEnabled.value;
}

function changeRows(newRows) {
    rows.value = newRows;
    showRowsDropdown.value = false;

    if (engine && render) {
        Matter.World.clear(engine.world);
        Matter.Engine.clear(engine);
        Matter.Render.stop(render);

        setTimeout(() => {
            initializePlinko();
        }, 100);
    }
}

function handleOutsideClick(event) {
    if (!event.target.closest('.main-input-small')) {
        showRowsDropdown.value = false;
    }
}

function dropABall() {
    if (balls.value > 0) {
        balls.value -= 1;
    }
    const width = 620;
    const PEG_RAD = 4;

    const dropLeft = width / 2 - currentGAP;
    const dropRight = width / 2 + currentGAP;
    const dropWidth = dropRight - dropLeft;
    const x = Math.random() * dropWidth + dropLeft;
    const y = -PEG_RAD;

    const ball = Matter.Bodies.circle(x, y, currentBallRadius, {
        label: "Ball",
        restitution: 0.6,
        render: {
            fillStyle: "#f23",
        },
    });

    if (!clickSynth) {
        clickSynth = new Tone.NoiseSynth({ volume: -26 }).toDestination();
    }

    if (soundEnabled.value) {
        Tone.start().then(() => {
            clickSynth.triggerAttackRelease("32n", Tone.context.currentTime);
        });
    }

    Matter.Composite.add(engine.world, [ball]);
}

function getWidthNotes(rows) {
    if(rows < 12) {
        return 42;
    }
    else if(rows < 15) {
        return 34;
    }
    return (27 / rows) + 28;
}
</script>

<template>
    <MainLayout>
        <div class="plinko-game">
            <div class="controls">
                <div></div>
                <div>
                    <div id="balls">{{ balls }}</div>
                </div>
                <div class="drop-container">
                    <div class="status-display">
                        <div
                            class="status-text"
                            :class="{
                                'result-showing': lastResult.includes('x'),
                                dropping: lastResult === 'Dropping...',
                                waiting: lastResult === 'Waiting...',
                            }"
                        >
                            {{ lastResult }}
                        </div>
                    </div>
                </div>
                <div>
                    <div id="multiplier">{{ multiplier }}</div>
                </div>
                <div></div>
            </div>
            <div class="canvas-container">
                <canvas id="canvas" ref="canvas"></canvas>
            </div>

                        <div class="notes">
                <div
                    v-for="(mult, index) in getMultipliers(rows)"
                    :key="index"
                    type="button"
                    class="note"
                    :style="{ width: getWidthNotes(rows) + 'px' }"
                    :id="`note-${index}`"
                >
                    {{ mult }}x
                </div>
            </div>

            <div class="bg-secondary-bg/80 max-w-[850px] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border mt-4">
                <div class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1">
                    <input
                        v-model="betAmount"
                        type="number"
                        placeholder="Bet amount"
                        step="0.01"
                        min="0.01"
                    />
                    <div
                        class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg cursor-pointer"
                        @click="setBetHalf"
                    >
                        1/2
                    </div>
                    <div
                        class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg cursor-pointer"
                        @click="setBetDouble"
                    >
                        2X
                    </div>
                </div>

                <div class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative">
                    <span class="text-gray">Rows</span>
                    <div
                        class="flex gap-1 items-center cursor-pointer"
                        @click="showRowsDropdown = !showRowsDropdown"
                    >
                        {{ rows }}
                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.5" d="M6 7C6.23051 7 6.42712 6.91052 6.60339 6.72468L11.7763 1.35595C11.9254 1.21141 12 1.01868 12 0.798427C12 0.351032 11.661 0 11.2136 0C10.9966 0 10.8 0.089479 10.6508 0.240905L6 5.07965L1.34915 0.240905C1.19322 0.089479 0.99661 0 0.779661 0C0.338983 0 0 0.351032 0 0.798427C0 1.01868 0.0745763 1.21141 0.223729 1.35595L5.39661 6.72468C5.57288 6.91052 5.76949 6.99312 6 7Z" fill="#CAD9FF"/>
                        </svg>
                    </div>

                    <div v-if="showRowsDropdown" class="bg-secondary-sidebar border-secondary-bg overflow-y-auto absolute right-0 left-0 top-full z-10 mt-1 max-h-40 rounded-lg border">
                        <div
                            v-for="option in rowsOptions"
                            :key="option"
                            class="hover:bg-secondary-bg px-3 py-2 cursor-pointer"
                            @click="changeRows(option)"
                        >
                            {{ option }}
                        </div>
                    </div>
                </div>

                <button
                    @click="toggleSound"
                    :class="[
                        'btn before:hidden flex flex-shrink-0 justify-center items-center w-11 h-11 rounded-xl transition-all',
                        soundEnabled ? 'bg-primary/20 text-primary' : 'bg-white/10 text-white/50'
                    ]"
                >
                    <svg v-if="soundEnabled" width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z" fill="currentColor"/>
                    </svg>
                    <svg v-else width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z" fill="currentColor"/>
                    </svg>
                </button>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.plinko-game {
    font-family: "Montserrat", sans-serif;
    background-color: #14151f;
    min-height: 100vh;
    padding: 20px;
}

button {
    font-family: inherit;
    font-weight: 600;
    cursor: pointer;
    opacity: 0.8;
}
button:hover {
    opacity: 1;
}
button:active {
    opacity: 0.8;
}

.controls {
    display: grid;
    grid-template-columns: 0.5fr 1fr 1fr 1fr 0.5fr;
    align-items: center;
    justify-content: center;
    margin-top: 3em;
    gap: 1em;
}
.controls .drop-container {
    display: flex;
    justify-content: center;
}

.controls .drop-container .status-display {
    display: flex;
    justify-content: center;
    align-items: center;
}

.controls .drop-container .status-text {
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 10px;
    padding: 1em 1.5em;
    background: #444;
    color: white;
    font-weight: 600;
    font-size: 1em;
    min-width: 8em;
    transition: all 0.3s ease;
}

.controls .drop-container .status-text.result-showing {
    background: #ffd700;
    color: #000;
    font-weight: bold;
    animation: pulse 0.5s ease-in-out;
}

.controls .drop-container .status-text.dropping {
    background: #ff6b6b;
    color: white;
    animation: blink 1s infinite;
}

.controls .drop-container .status-text.waiting {
    background: #666;
    color: #ccc;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes blink {
    0%,
    100% {
        opacity: 1;
    }
    50% {
        opacity: 0.6;
    }
}

#balls,
#multiplier {
    position: relative;
    font-weight: 900;
    font-size: 2.2em;
    margin-right: auto;
    color: rgba(255, 255, 255, 0.2);
}
#balls:before,
#multiplier:before {
    content: "-";
    position: absolute;
    bottom: 100%;
    font-size: 0.3em;
    font-weight: 400;
}

#balls:before {
    content: "Balls";
}

#multiplier {
    text-align: right;
}
#multiplier:before {
    content: "Drop";
    right: 0;
}

.canvas-container {
    display: flex;
    align-items: center;
    justify-content: center;
}
.canvas-container canvas {
    display: block;
    margin: auto;
}

 .notes {
     display: flex;
     align-items: flex-end;
     justify-content: center;
     gap: 5px;
     margin-top: 20px;
 }
.notes .note {
    display: flex;
    align-items: center;
    justify-content: center;

    aspect-ratio: 30/26;
    border-radius: 5px;
    background-color: gray;
    flex-shrink: 0;
    border-bottom: solid 4px yellow;
    text-align: center;
    font-size: 0.8em;
    font-weight: 600;
}
.notes .note[data-pressed="true"] {
    animation: press 0.5s;
}
@keyframes press {
    0% {
        border-bottom-width: 4px;
    }
    50% {
        border-bottom-width: 0;
    }
    100% {
        border-bottom-width: 4px;
    }
}
.notes .note:nth-child(1),
.notes .note:nth-child(17) {
    background-color: #0f3;
    border-color: #0a0;
}
.notes .note:nth-child(2),
.notes .note:nth-child(16) {
    background-color: #1f3;
    border-color: #0a0;
}
.notes .note:nth-child(3),
.notes .note:nth-child(15) {
    background-color: #3f2;
    border-color: #0a0;
}
.notes .note:nth-child(4),
.notes .note:nth-child(14) {
    background-color: #4f2;
    border-color: #0a0;
}
.notes .note:nth-child(5),
.notes .note:nth-child(13) {
    background-color: #6f2;
    border-color: #0a0;
}
.notes .note:nth-child(6),
.notes .note:nth-child(12) {
    background-color: #7f1;
    border-color: #3a0;
}
.notes .note:nth-child(7),
.notes .note:nth-child(11) {
    background-color: #9f1;
    border-color: #4a0;
}
.notes .note:nth-child(8),
.notes .note:nth-child(10) {
    background-color: #af0;
    border-color: #6a0;
}
 .notes .note:nth-child(9) {
     background-color: #cf0;
     border-color: #7a0;
 }

 .main-input-small {
     @apply flex items-center gap-2 px-4 py-3 bg-secondary-sidebar rounded-xl border border-transparent;
 }

 .main-input-small input {
     @apply bg-transparent border-none outline-none text-white flex-1;
 }

 .text-gray {
     @apply text-gray-400;
 }

 .btn {
     @apply relative overflow-hidden transition-all duration-300;
 }

 .btn-primary {
     @apply bg-primary text-white hover:bg-primary/90;
 }

 .btn:disabled {
     @apply opacity-50 cursor-not-allowed;
 }
 </style>
