<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import PrizePool from "@/Components/Main/Global/PrizePool.vue";

const terms_rows_1 = [
    {
        title: "You must maintain an account in good standing on Domain",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M19.8332 17.5H8.1665V22.1667H19.8332V17.5Z" fill="#E8EDFF"/>
<path opacity="0.35" d="M13.9998 13.9987C17.2215 13.9987 19.8332 11.387 19.8332 8.16537C19.8332 4.9437 17.2215 2.33203 13.9998 2.33203C10.7782 2.33203 8.1665 4.9437 8.1665 8.16537C8.1665 11.387 10.7782 13.9987 13.9998 13.9987Z" fill="#E8EDFF"/>
<path d="M24.4336 20.307C24.1151 18.6445 22.567 17.5 20.8741 17.5H17.5001L14.0001 22.1667L10.5001 17.5H8.16798C5.43331 17.5 3.88514 18.6445 3.56664 20.307C3.13731 22.5435 4.84064 24.5 7.00014 24.5H21.0001C23.1596 24.5 24.863 22.5435 24.4336 20.307Z" fill="#E8EDFF"/>
</svg>
`
    },
    {
        title: "The lottery takes into account bets placed on both Original Games and Slots",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M5.8335 4.66797C3.90033 4.66797 2.3335 6.2348 2.3335 8.16797V10.716C3.69033 11.1978 4.66683 12.48 4.66683 14.0013C4.66683 15.5226 3.69033 16.8048 2.3335 17.2866V19.8346C2.3335 21.7678 3.90033 23.3346 5.8335 23.3346H19.8335V4.66797H5.8335Z" fill="#E8EDFF"/>
<path d="M25.6668 19.8346V17.2866C24.31 16.8048 23.3335 15.5226 23.3335 14.0013C23.3335 12.48 24.31 11.1978 25.6668 10.716V8.16797C25.6668 6.2348 24.1 4.66797 22.1668 4.66797H19.8335V23.3346H22.1668C24.1 23.3346 25.6668 21.7678 25.6668 19.8346Z" fill="#E8EDFF"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.4133 9.88008C11.5276 9.66542 11.7504 9.53125 11.9931 9.53125C12.2358 9.53125 12.4598 9.66542 12.5729 9.88008L13.6743 11.9567C13.6871 11.9812 13.7046 12.0011 13.7268 12.0174C13.7489 12.0337 13.7746 12.0443 13.8014 12.0489L16.1161 12.4549C16.3553 12.4969 16.5524 12.6673 16.6271 12.8994C16.7018 13.1304 16.6434 13.3848 16.4743 13.5598L14.8398 15.2491C14.8211 15.2689 14.8071 15.2923 14.7978 15.3179C14.7896 15.3436 14.7873 15.3716 14.7908 15.3984L15.1198 17.7259C15.1536 17.9663 15.0521 18.2066 14.8561 18.3501C14.6589 18.4936 14.3999 18.5158 14.1818 18.4084L12.0713 17.3759C12.0468 17.3643 12.0199 17.3573 11.9931 17.3573C11.9663 17.3573 11.9394 17.3631 11.9149 17.3748L9.80443 18.4073C9.58626 18.5146 9.3261 18.4913 9.1301 18.3489C8.93293 18.2054 8.83143 17.9663 8.86643 17.7248L9.19543 15.3973C9.19893 15.3704 9.1966 15.3424 9.18843 15.3168C9.18026 15.2911 9.16626 15.2666 9.14643 15.2479L7.51193 13.5586C7.34276 13.3836 7.28443 13.1304 7.3591 12.8982C7.43376 12.6672 7.63093 12.4969 7.8701 12.4538L10.1848 12.0477C10.2116 12.0431 10.2373 12.0326 10.2594 12.0163C10.2816 11.9999 10.2991 11.9801 10.3119 11.9556L11.4133 9.88008Z" fill="#E8EDFF"/>
</svg>
`
    },
    {
        title: "Your account must not violate our Terms of Service",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M22.1665 22.1667V7C22.1665 5.06683 20.5997 3.5 18.6665 3.5H8.1665C6.23334 3.5 4.6665 5.06683 4.6665 7V21C4.6665 22.9332 6.23334 24.5 8.1665 24.5H24.4998C23.2107 24.5 22.1665 23.4558 22.1665 22.1667Z" fill="#E8EDFF"/>
<path d="M15.1665 7V8.16667C15.1665 9.45583 14.1223 10.5 12.8332 10.5H3.49984C2.21067 10.5 1.1665 9.45583 1.1665 8.16667V7C1.1665 5.06683 2.73334 3.5 4.6665 3.5H18.6665C16.7333 3.5 15.1665 5.06683 15.1665 7Z" fill="#E8EDFF"/>
<path d="M24.4998 18.668H22.1665V22.168C22.1665 23.4571 23.2107 24.5013 24.4998 24.5013C25.789 24.5013 26.8332 23.4571 26.8332 22.168V21.0013C26.8332 19.7121 25.789 18.668 24.4998 18.668Z" fill="#E8EDFF"/>
<path d="M16.3332 15.1654H9.33317C8.688 15.1654 8.1665 14.6427 8.1665 13.9987C8.1665 13.3547 8.688 12.832 9.33317 12.832H16.3332C16.9783 12.832 17.4998 13.3547 17.4998 13.9987C17.4998 14.6427 16.9783 15.1654 16.3332 15.1654Z" fill="#E8EDFF"/>
<path d="M13.9998 19.8333H9.33317C8.688 19.8333 8.1665 19.3107 8.1665 18.6667C8.1665 18.0227 8.688 17.5 9.33317 17.5H13.9998C14.645 17.5 15.1665 18.0227 15.1665 18.6667C15.1665 19.3107 14.645 19.8333 13.9998 19.8333Z" fill="#E8EDFF"/>
</svg>
`
    },
    {
        title: "Domain reserves the right to invalidate, suspend, cancel, or modify this promotion should it become necessary",
        icon: `
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M23.3461 4.65325C21.8084 3.11558 19.3152 3.11558 17.7776 4.65325L4.90924 17.4971C4.55691 17.8494 4.32241 18.3009 4.23724 18.7921L3.51974 22.9536C3.36458 23.8542 4.14741 24.6359 5.04808 24.4796L9.16058 23.7644C9.64824 23.6793 10.0986 23.4459 10.4486 23.0959L23.3461 10.2206C24.8849 8.68292 24.8849 6.19092 23.3461 4.65325Z" fill="#E8EDFF"/>
<path d="M15.2544 7.16978L20.8229 12.7383L23.1376 10.4318L17.5691 4.86328L15.2544 7.16978Z" fill="#E8EDFF"/>
<path d="M3.95724 20.418L3.51974 22.9555C3.36458 23.8561 4.14741 24.6378 5.04808 24.4815L7.58091 24.0405L3.95724 20.418Z" fill="#E8EDFF"/>
</svg>

        `
    },
]
const terms_rows_2 = [
    {
        title: "Entries will be void if a participant is found to be involved in fraud, misrepresentation, hacking, or exploitation",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M24.5 11.668C24.5 3.5013 17.5 3.5013 17.5 3.5013C17.5 2.21214 16.4558 1.16797 15.1667 1.16797H14C8.2005 1.16797 3.5 5.86847 3.5 11.668V15.168C3.5 15.3593 3.55717 15.532 3.63767 15.6906C3.556 15.8913 3.5 16.1036 3.5 16.3346C3.5 17.261 4.22217 18.0123 5.13333 18.073C6.356 21.804 9.86067 24.5013 14 24.5013C18.1393 24.5013 21.644 21.804 22.8667 18.073C23.7778 18.0123 24.5 17.261 24.5 16.3346C24.5 16.1036 24.444 15.8913 24.3623 15.6906C24.4428 15.532 24.5 15.3593 24.5 15.168V11.668Z" fill="#E8EDFF"/>
<path d="M5.8335 14.5389V15.1654C5.8335 17.7425 7.937 19.832 10.5002 19.832C12.2875 19.832 12.8335 18.6654 14.0002 18.6654C15.1668 18.6654 15.7128 19.832 17.5002 19.832C20.0633 19.832 22.1668 17.7425 22.1668 15.1654V14.5389C22.1668 13.5962 21.4027 12.832 20.46 12.832H7.54033C6.59766 12.832 5.8335 13.5962 5.8335 14.5389ZM18.4685 17.1499C17.6203 17.6725 16.5097 17.4089 15.987 16.5619L19.0565 14.6684C19.5803 15.5165 19.3167 16.6272 18.4685 17.1499ZM8.94266 14.6684L12.0122 16.5619C11.4895 17.41 10.3788 17.6725 9.53066 17.1499C8.6825 16.6272 8.42 15.5165 8.94266 14.6684Z" fill="#E8EDFF"/>
</svg>

`
    },
    {
        title: "Domain reserves the right to conduct additional KYC/AML checks as a condition of prize fulfillment",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M25.605 9.3017C25.6715 8.12336 24.8443 7.04187 23.6788 6.84937C18.836 6.05253 19.2082 2.33203 14.0002 2.33203C8.79218 2.33203 9.16434 6.05253 4.32151 6.84937C3.15601 7.0407 2.32884 8.1222 2.39534 9.3017C2.89468 18.2034 6.45651 22.4325 14.0002 25.6654C21.5438 22.4325 25.1057 18.2034 25.605 9.3017Z" fill="#E8EDFF"/>
<path d="M12.8335 18.667C12.5348 18.667 12.2361 18.5526 12.0086 18.3251L8.50863 14.8251C8.05246 14.369 8.05246 13.6316 8.50863 13.1755C8.9648 12.7193 9.70213 12.7193 10.1583 13.1755L12.8335 15.8506L17.842 10.8421C18.2981 10.386 19.0355 10.386 19.4916 10.8421C19.9478 11.2983 19.9478 12.0356 19.4916 12.4918L13.6583 18.3251C13.4308 18.5526 13.1321 18.667 12.8335 18.667Z" fill="#E8EDFF"/>
</svg>

`
    },
    {
        title: "Affiliates and employees of Domain are not eligible to receive prizes",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M14.0002 25.6654C20.4435 25.6654 25.6668 20.442 25.6668 13.9987C25.6668 7.55538 20.4435 2.33203 14.0002 2.33203C7.55684 2.33203 2.3335 7.55538 2.3335 13.9987C2.3335 20.442 7.55684 25.6654 14.0002 25.6654Z" fill="#E8EDFF"/>
<path d="M20.2396 17.1628C20.7226 16.212 21.0002 15.1398 21.0002 14C21.0002 10.1337 17.8666 7 14.0002 7C12.8604 7 11.7882 7.27767 10.8374 7.76067L20.2396 17.1628Z" fill="#E8EDFF"/>
<path d="M7.76067 10.8359C7.27767 11.7868 7 12.8589 7 13.9988C7 17.8651 10.1337 20.9988 14 20.9988C15.1398 20.9988 16.212 20.7211 17.1628 20.2381L7.76067 10.8359Z" fill="#E8EDFF"/>
</svg>

`
    },

]
</script>

<template>
    <MainLayout>
        <div class="flex flex-col gap-4 mx-auto">
            <div class="rounded-xl w-full min-h-[230px] bg-container flex items-center justify-center">
            </div>
            <div class="flex flex-col gap-8 p-6 rounded-xl">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[22px] font-bold">
                        Ticket of Fortune
                    </h1>
                    <p class="text-secondary-light/50 max-w-[1080px]">
                        $150,000 Every Week from Domain! Join the Weekly Raffle and Hit the Jackpot! For every $1000 wagered on original games and slots, you automatically receive a ticket into the weekly raffle. No extra conditions – just play your favorite games and collect tickets! More tickets, more chances to win! Start earning tickets right now and get ready to win! Good luck!
                    </p>
                </div>
                <div class="bg-secondary-sidebar flex gap-16 items-center p-4 rounded-xl">
                    <PrizePool win_amount="$150,000.00" />
                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">Split between 30 players</h1>
                        <p class="text-secondary-light/75">An incredible prize pool is divided among Moneycounter players who participate</p>
                    </div>

                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="text-[22px] font-bold">
                        How to Enter
                    </h1>
                    <div class="max-lg:grid-cols-1 grid grid-cols-2 gap-4 items-stretch">
                        <div class="bg-secondary-sidebar flex gap-4 items-center px-4 py-4 w-full rounded-xl">
                            <div class="counter_news px-4 py-2 text-lg font-bold">
                                1
                            </div>
                            <p class="text-secondary-light">Be a registered member of Domain</p>
                        </div>
                        <div class="bg-secondary-sidebar flex gap-4 items-center px-4 py-4 w-full rounded-xl">
                            <div class="counter_news px-4 py-2 text-lg font-bold">
                                2
                            </div>
                            <p class="text-secondary-light">Place bets on Original Games or Slots</p>
                        </div>

                    </div>

                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="text-[22px] font-bold">
                        Terms and Conditions
                    </h1>
                    <div class="flex flex-col gap-4">
                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="term in terms_rows_1" class="bg-secondary-sidebar flex flex-col gap-4 p-4 rounded-xl">
                                <div class="counter_news w-fit px-3 py-2 text-lg font-bold">
                                    <div v-html="term.icon"></div>
                                </div>
                                <p class="text-secondary-light">{{ term.title }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div v-for="term in terms_rows_2" class="bg-secondary-sidebar flex flex-col gap-4 p-4 rounded-xl">
                                <div class="counter_news w-fit px-3 py-2 text-lg font-bold">
                                    <div v-html="term.icon"></div>
                                </div>
                                <p class="text-secondary-light">{{ term.title }}</p>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary flex justify-center">Bonuses page</button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.bg-container {
    background: url('/assets/images/news/bg/bg_promo.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
