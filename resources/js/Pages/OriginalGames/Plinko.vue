<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { ref, onMounted, onUnmounted, computed } from "vue";
import { usePlinkoStore } from "@/stores/PlinkoStore.js";
import { useUserStore } from "@/stores/userStore.js";

const store = usePlinkoStore();

const canvas = ref(null);
const showRowsDropdown = ref(false);

const rowsOptions = [8, 9, 10, 11, 12, 13, 14, 15, 16];

let engine, render, pegs, pegAnims, notes, autoDroppingInterval;
let clickSynth;
let currentBallRadius = 7;
let currentGAP = 32;

const betAmount = computed(() => store.betAmount);
const rows = computed(() => store.rows);
const userStore = useUserStore();
const soundEnabled = computed(() => store.soundEnabled);
const isCollecting = ref(false);
const multipliers = computed(() => store.multipliers);
const widthNotes = computed(() => store.widthNotes);

onMounted(() => {
    loadLibrariesAndInit();
    // setInterval(() => {
    //     bet();
    // }, 5000);
    document.addEventListener("click", handleOutsideClick);
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
    document.removeEventListener("click", handleOutsideClick);
});

function initializePlinko() {
    const width = 620;
    const currentRows = rows.value;

    const baseGap = 32;
    const gapMultiplier = Math.max(1, (16 - currentRows) * 0.06 + 1);
    const GAP = Math.round(baseGap * gapMultiplier);
    currentGAP = GAP;

    const baseHeight = 0;
    const height = baseHeight + currentRows * GAP + 10;

    const ballSizeMultiplier = Math.max(1, (16 - currentRows) * 0.1 + 1);
    const BALL_RAD = Math.round(7 * ballSizeMultiplier);
    currentBallRadius = BALL_RAD;


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
            background: "transparent",
        },
    });

    if (canvas.value) {
        canvas.value.style.height = height + "px";
        canvas.value.style.width = width + "px";
        canvas.value.style.background = "transparent";
    }

    const basePegRadius = 4;
    const pegMultiplier = Math.max(1, (16 - currentRows) * 0.08 + 1);
    const PEG_RAD = Math.round(basePegRadius * pegMultiplier);

    pegs = [];


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

            const currentMultipliers = multipliers.value;
            const numBuckets = currentMultipliers.length;
            const leftEdge = width / 2 - ((numBuckets - 1) / 2) * currentGAP;
            const index = Math.floor(
                (ballToRemove.position.x - leftEdge) / currentGAP
            );
            const clampedIndex = Math.max(0, Math.min(numBuckets - 1, index));

            if (clampedIndex >= 0 && clampedIndex < numBuckets) {
                const multiplierValue = currentMultipliers[clampedIndex];
                const ballsWon =
                    multiplierValue > 0 ? Math.floor(multiplierValue) : 0;
                store.addBalls(ballsWon);

                store.setLastResult(`${multiplierValue}x`);
                console.log(isCollecting.value);
                if (isCollecting.value) {
                    store.savePositionToDatabase(
                        ballToRemove.startX,
                        ballToRemove.position.x,
                        clampedIndex,
                        multiplierValue
                    );
                }

                const el = document.getElementById(`note-${clampedIndex}`);
                if (el && el.dataset.pressed !== "true") {
                    const note = notes[clampedIndex % notes.length];
                    if (soundEnabled.value) {
                        Tone.start().then(() => note.play());
                    }
                    el.dataset.pressed = true;
                    setTimeout(() => {
                        el.dataset.pressed = false;
                    }, 500);
                }
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
}

function dropABall(positionX) {
    if (!store.useBall()) return;

    const width = 620;
    const dropLeft = width / 2 - currentGAP;
    const dropRight = width / 2 + currentGAP;
    const dropWidth = dropRight - dropLeft;
    const x = positionX || Math.random() * dropWidth + dropLeft;
    const y = -4;

    const ball = Matter.Bodies.circle(x, y, currentBallRadius, {
        label: "Ball",
        restitution: 0.6,
        render: {
            fillStyle: "#298AFF",
            strokeStyle: "rgba(255, 255, 255, 0.2)",
            lineWidth: 2,
            sprite: {
                texture: createBallTexture(currentBallRadius),
                xScale: 1,
                yScale: 1
            }
        }
    });

    ball.startX = x;

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

function setBetHalf() {
    store.setBetHalf();
}

function setBetDouble() {
    store.setBetDouble();
}

function toggleSound() {
    store.toggleSound();
}

function changeRows(newRows) {
    store.setRows(newRows);
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

async function bet() {
    // dropABall()
    const response = await store.placeBet();
    if (response) {
        dropABall(response.start_position_x);
    }
}

function handleOutsideClick(event) {
    if (!event.target.closest(".main-input-small")) {
        showRowsDropdown.value = false;
    }
}

// Функция для создания текстуры мячика с градиентом
function createBallTexture(radius) {
    const canvas = document.createElement('canvas');
    const size = radius * 2 + 4; // Добавляем отступ для свечения
    canvas.width = size;
    canvas.height = size;
    const ctx = canvas.getContext('2d');

    // Создаем радиальный градиент
    const gradient = ctx.createRadialGradient(
        radius * 0.5, radius * 0.5, 0,
        radius, radius, radius * 2
    );
    gradient.addColorStop(0, '#5CA6FF');
    gradient.addColorStop(1, '#298AFF');

    // Рисуем круг с градиентом
    ctx.beginPath();
    ctx.arc(radius, radius, radius - 1, 0, Math.PI * 2);
    ctx.fillStyle = gradient;
    ctx.fill();

    // Добавляем обводку
    ctx.strokeStyle = 'rgba(255, 255, 255, 0.2)';
    ctx.lineWidth = 2;
    ctx.stroke();

    // Добавляем свечение (эффект тени)
    ctx.shadowColor = 'rgba(41, 138, 255, 0.5)';
    ctx.shadowBlur = 7;
    ctx.shadowOffsetX = 0;
    ctx.shadowOffsetY = 0;
    ctx.fill();

    return canvas.toDataURL();
}
</script>

<template>
    <MainLayout>
        <div class="bg-mines container flex flex-col mx-auto rounded-xl">
            <div class="plinko-game">
                <div class="flex flex-col">
                    <div class="canvas-container">
                        <canvas id="canvas" ref="canvas"></canvas>
                    </div>

                    <div class="notes">
                        <div
                            v-for="(mult, index) in multipliers"
                            :key="index"
                            type="button"
                            class="note"
                            :style="{ width: widthNotes + 'px' }"
                            :id="`note-${index}`"
                        >
                            {{ mult }}
                        </div>
                    </div>
                </div>

                <div
                    class="bg-secondary-bg/80 mx-auto max-w-[850px] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border mt-6"
                >
                    <div
                        class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1"
                    >
                        <input
                            :value="betAmount"
                            @input="
                                store.setBetAmount(
                                    parseFloat($event.target.value) || 0.01
                                )
                            "
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

                    <div
                        class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                    >
                        <span class="text-gray">Rows</span>
                        <div
                            class="flex gap-1 items-center cursor-pointer"
                            @click="showRowsDropdown = !showRowsDropdown"
                        >
                            {{ rows }}
                            <svg
                                width="12"
                                height="7"
                                viewBox="0 0 12 7"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    opacity="0.5"
                                    d="M6 7C6.23051 7 6.42712 6.91052 6.60339 6.72468L11.7763 1.35595C11.9254 1.21141 12 1.01868 12 0.798427C12 0.351032 11.661 0 11.2136 0C10.9966 0 10.8 0.089479 10.6508 0.240905L6 5.07965L1.34915 0.240905C1.19322 0.089479 0.99661 0 0.779661 0C0.338983 0 0 0.351032 0 0.798427C0 1.01868 0.0745763 1.21141 0.223729 1.35595L5.39661 6.72468C5.57288 6.91052 5.76949 6.99312 6 7Z"
                                    fill="#CAD9FF"
                                />
                            </svg>
                        </div>

                        <div
                            v-if="showRowsDropdown"
                            class="bg-secondary-sidebar border-secondary-bg overflow-y-auto absolute right-0 left-0 top-full z-10 mt-1 max-h-40 rounded-lg border"
                        >
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
                    <div
                        class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                    >
                        <span class="text-gray">Rows</span>
                        <div
                            class="flex gap-1 items-center cursor-pointer"
                            @click="showRowsDropdown = !showRowsDropdown"
                        >
                            {{ rows }}
                            <svg
                                width="12"
                                height="7"
                                viewBox="0 0 12 7"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    opacity="0.5"
                                    d="M6 7C6.23051 7 6.42712 6.91052 6.60339 6.72468L11.7763 1.35595C11.9254 1.21141 12 1.01868 12 0.798427C12 0.351032 11.661 0 11.2136 0C10.9966 0 10.8 0.089479 10.6508 0.240905L6 5.07965L1.34915 0.240905C1.19322 0.089479 0.99661 0 0.779661 0C0.338983 0 0 0.351032 0 0.798427C0 1.01868 0.0745763 1.21141 0.223729 1.35595L5.39661 6.72468C5.57288 6.91052 5.76949 6.99312 6 7Z"
                                    fill="#CAD9FF"
                                />
                            </svg>
                        </div>

                        <div
                            v-if="showRowsDropdown"
                            class="bg-secondary-sidebar border-secondary-bg overflow-y-auto absolute right-0 left-0 top-full z-10 mt-1 max-h-40 rounded-lg border"
                        >
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
                        @click="bet"
                        class="btn btn-primary flex-shrink-0 px-8"
                    >
                        Bet
                    </button>
                    <button
                        @click="toggleSound"
                        :class="[
                            'btn before:hidden flex flex-shrink-0 justify-center items-center w-11 h-11 rounded-xl transition-all',
                            soundEnabled
                                ? 'bg-primary/20 text-primary'
                                : 'bg-white/10 text-white/50',
                        ]"
                    >
                        <svg
                            v-if="soundEnabled"
                            width="18"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"
                                fill="currentColor"
                            />
                        </svg>
                        <svg
                            v-else
                            width="18"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"
                                fill="currentColor"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div
                class="bg-secondary-sidebar-dark border-blue_dark flex justify-between items-center p-6 rounded-b-xl border-t"
            >
                <div class="flex gap-1 items-center font-extrabold uppercase">
                    <span class="text-dark-text-2">Mines</span>
                    <span class="text-dark-text-3">Original Game</span>
                </div>
                <div
                    class="bg-blue_light/5 flex gap-2 items-center py-1 pr-4 pl-1 rounded-full"
                >
                    <img
                        src="/assets/images/header/default_avatar.png"
                        alt="avatar"
                        class="w-7 h-7 rounded-full"
                    />
                    <span class="text-blue_dark_2">{{
                        userStore.user?.name || "Guest"
                    }}</span>
                    <span
                        class="text-blue_light font-bold transition-all duration-300"
                        :class="{
                            'text-green-400':
                                previousBalance !== userStore.user?.balance,
                        }"
                    >
                        {{ userStore.user?.balance || "0.00" }}
                    </span>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.test-panel {
    background: #1e2b5e;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 20px;
    text-align: center;
}

.test-panel h2 {
    margin: 0 0 15px 0;
    color: #4caf50;
}

.test-controls {
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

.test-controls input {
    padding: 8px 12px;
    border-radius: 8px;
    border: none;
    background: #2a3f7a;
    color: white;
    width: 100px;
}

.btn-start {
    background: #4caf50;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-start:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.btn-stop {
    background: #f44336;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-stop:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.progress {
    background: #2a3f7a;
    padding: 8px 16px;
    border-radius: 8px;
    color: white;
    font-weight: bold;
}

.plinko-game {
    font-family: "Montserrat", sans-serif;
    padding: 20px;
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
    margin-top: 10px;
}
.note::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50%;
    height: 4px;
    background: #192643;
    border-radius: 5px;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.notes .note {
    display: flex;
    align-items: center;
    position: relative;
    justify-content: center;
    aspect-ratio: 30/26;
    border-radius: 5px;
    background: linear-gradient(180deg, #8FC2FF 0%, #298AFF 100%);
    flex-shrink: 0;
    text-align: center;
    font-size: 12px;
    font-weight: 600;
    filter: drop-shadow(0px 3.77px 0px rgba(41, 138, 255, 0.25)) drop-shadow(0px 7.54px 7.54px rgba(41, 138, 255, 0.25));
}
.notes .note[data-pressed="true"] {
    animation: press 0.5s;
}
@keyframes press {
    0% {
        scale: 1;
    }
    50% {
        scale: 0.95;
    }
    100% {
        scale: 1;
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
</style>
