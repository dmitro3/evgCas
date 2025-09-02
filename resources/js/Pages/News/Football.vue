<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";

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
    {
        title: "Each player is eligible to receive all rewards only once",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M26.4694 20.6342L22.5891 16.7539C22.7932 17.9147 22.4036 19.2774 21.4247 20.2562C20.3304 21.3506 18.7542 21.7146 17.5187 21.3272C17.3029 21.7402 16.9832 22.1147 16.5947 22.4262L20.6361 26.4676C21.3174 27.1489 22.4829 26.8269 22.7174 25.8912L23.0884 24.4061C23.2506 23.7562 23.7581 23.2487 24.4079 23.0866L25.8931 22.7156C26.8287 22.4811 27.1507 21.3156 26.4694 20.6342Z" fill="#E8EDFF"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M1.53051 20.6342L5.41084 16.7539C5.20667 17.9147 5.59634 19.2774 6.57517 20.2562C7.66951 21.3506 9.24567 21.7146 10.4812 21.3272C10.697 21.7402 11.0167 22.1147 11.4052 22.4262L7.36384 26.4676C6.68251 27.1489 5.51701 26.8269 5.28251 25.8912L4.91151 24.4061C4.74934 23.7562 4.24184 23.2487 3.59201 23.0866L2.10684 22.7156C1.17117 22.4811 0.849172 21.3156 1.53051 20.6342Z" fill="#E8EDFF"/>
<path opacity="0.35" fill-rule="evenodd" clip-rule="evenodd" d="M10.4813 4.33636C11.081 3.18953 12.453 2.33203 14 2.33203C15.547 2.33203 16.919 3.18953 17.5187 4.33636C18.753 3.94903 20.3303 4.31303 21.4247 5.40736C22.519 6.5017 22.883 8.07786 22.4957 9.31336C23.6425 9.91303 24.5 11.285 24.5 12.832C24.5 14.379 23.6425 15.751 22.4957 16.3507C22.883 17.585 22.519 19.1624 21.4247 20.2567C20.3303 21.351 18.7542 21.715 17.5187 21.3277C16.919 22.4745 15.547 23.332 14 23.332C12.453 23.332 11.081 22.4745 10.4813 21.3277C9.247 21.715 7.66967 21.351 6.57533 20.2567C5.481 19.1624 5.117 17.5862 5.50433 16.3507C4.3575 15.751 3.5 14.379 3.5 12.832C3.5 11.285 4.3575 9.91303 5.50433 9.31336C5.117 8.07903 5.481 6.5017 6.57533 5.40736C7.66967 4.31303 9.24583 3.94903 10.4813 4.33636Z" fill="#E8EDFF"/>
<path d="M13.0969 16.4665V10.6203L12.5416 11.0391C12.0948 11.3763 11.4543 11.2445 11.1766 10.7591C10.9409 10.3496 11.0518 9.8293 11.4333 9.5493L12.9534 8.4363C13.1914 8.26247 13.4796 8.16797 13.7759 8.16797C14.5436 8.16797 15.1666 8.79097 15.1666 9.55864V16.4653C15.1666 17.0381 14.7034 17.5013 14.1318 17.5013C13.5601 17.5013 13.0969 17.0381 13.0969 16.4665Z" fill="#E8EDFF"/>
</svg>

`
    },
    {
        title: "Bonus funds are withdrawable only after wagering requirements are met",
        icon: `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M22.1668 4.66797H17.4757C15.5565 4.66797 14.0002 6.2243 14.0002 8.14347C14.0002 6.2243 12.4438 4.66797 10.5247 4.66797H5.8335C3.90033 4.66797 2.3335 6.2348 2.3335 8.16797V19.8346C2.3335 21.7678 3.90033 23.3346 5.8335 23.3346H11.99C12.3937 24.0288 13.138 24.5013 14.0002 24.5013C14.8623 24.5013 15.6055 24.0288 16.0103 23.3346H22.1668C24.1 23.3346 25.6668 21.7678 25.6668 19.8346V8.16797C25.6668 6.2348 24.1 4.66797 22.1668 4.66797Z" fill="#E8EDFF"/>
<path d="M21.7783 11.0846L22.8668 10.2679C23.3825 9.88174 23.4863 9.15024 23.1001 8.63574C22.714 8.12008 21.9848 8.01624 21.4668 8.40241L19.8335 9.62624L18.2001 8.40124C17.6845 8.01508 16.953 8.11891 16.5668 8.63458C16.1795 9.14908 16.2845 9.88058 16.8001 10.2667L17.8898 11.0834L16.8001 11.9012C16.2845 12.2874 16.1806 13.0189 16.5668 13.5334C16.7955 13.8402 17.1466 14.0001 17.5013 14.0001C17.744 14.0001 17.9901 13.9242 18.2001 13.7667L19.8335 12.5417L21.4668 13.7667C21.6768 13.9242 21.923 14.0001 22.1656 14.0001C22.5203 14.0001 22.8703 13.8391 23.1001 13.5334C23.4875 13.0189 23.3825 12.2874 22.8668 11.9012L21.7783 11.0846Z" fill="#E8EDFF"/>
<path d="M22.1668 19.8333H17.5002C16.8562 19.8333 16.3335 19.3118 16.3335 18.6667C16.3335 18.0215 16.8562 17.5 17.5002 17.5H22.1668C22.8108 17.5 23.3335 18.0215 23.3335 18.6667C23.3335 19.3118 22.8108 19.8333 22.1668 19.8333Z" fill="#E8EDFF"/>
<path d="M8.1668 14.0005C7.8588 14.0005 7.5613 13.8792 7.34196 13.6587L5.00863 11.3253C4.55246 10.8692 4.55246 10.1318 5.00863 9.67567C5.4648 9.2195 6.20213 9.2195 6.6583 9.67567L7.98596 11.0033L9.52946 8.6875C9.88646 8.152 10.6098 8.00617 11.1476 8.36433C11.6831 8.7225 11.8278 9.44583 11.4708 9.9825L9.13746 13.4825C8.9438 13.773 8.6288 13.962 8.2823 13.9958C8.24263 13.9982 8.2053 14.0005 8.1668 14.0005Z" fill="#E8EDFF"/>
<path d="M10.4998 19.8333H5.83317C5.18917 19.8333 4.6665 19.3107 4.6665 18.6667C4.6665 18.0227 5.18917 17.5 5.83317 17.5H10.4998C11.1438 17.5 11.6665 18.0227 11.6665 18.6667C11.6665 19.3107 11.1438 19.8333 10.4998 19.8333Z" fill="#E8EDFF"/>
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
                        40M Users
                    </h1>
                    <p class="text-secondary-light/50 max-w-[1080px]">
                        We are celebrating an incredible achievement - 24 million users! And together with our partners, we are launching an exciting promotion to celebrate this achievement! At Domain, we value every player and strive to make your experience unforgettable. Our Domain cryptocurrency casino is more than just games, it is an innovative platform where everyone can feel a part of a huge community. Join and see for yourself! Big winnings, unique bonuses and fair, transparent play guaranteed by the reliability of the blockchain await you. Get a welcome bonus and open a world of incredible opportunities with Domain!
                    </p>
                </div>
                <div class="bg-secondary-sidebar flex gap-16 items-center p-4 rounded-xl">
                    <img src="/assets/images/news/content_banner/prize_pool.png" class="max-w-[350px] w-full" alt="">
                    <div class="flex flex-col gap-4">
                        <h1 class="text-3xl font-bold">Prize pool</h1>
                        <p class="text-secondary-light/75">An incredible prize pool is divided among Moneycounter players who participate</p>
                    </div>

                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="text-[22px] font-bold">
                        How to Enter
                    </h1>
                    <div class="max-lg:grid-cols-1 grid grid-cols-3 gap-4 items-stretch">
                        <div class="bg-secondary-sidebar flex gap-4 items-center px-4 py-8 w-full rounded-xl">
                            <div class="counter_news px-4 py-2 text-lg font-bold">
                                1
                            </div>
                            <p class="text-secondary-light">Be a registered member of Domain</p>
                        </div>
                        <div class="bg-secondary-sidebar flex gap-4 items-center px-4 py-8 w-full rounded-xl">
                            <div class="counter_news px-4 py-2 text-lg font-bold">
                                2
                            </div>
                            <p class="text-secondary-light">Place bets on Original Games or Slots</p>
                        </div>
                        <div class="bg-secondary-sidebar flex gap-4 items-center px-4 py-4 rounded-xl">
                            <div class="counter_news px-4 py-2 text-lg font-bold">
                                3
                            </div>
                            <p class="text-secondary-light">Find promo codes from our trusted partners, friends, or by following our promotions. Activate your promo code on the “Bonuses”</p>
                        </div>
                    </div>

                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-3xl font-bold">
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
                            <div class="grid grid-cols-5 gap-4">
                                <div v-for="term in terms_rows_2" class="bg-secondary-sidebar flex flex-col gap-4 p-4 rounded-xl">
                                    <div class="counter_news w-fit px-3 py-2 text-lg font-bold">
                                        <div v-html="term.icon"></div>
                                    </div>
                                    <p class="text-secondary-light">{{ term.title }}</p>
                                </div>
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
    background: url('/assets/images/news/bg/bg_football.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
