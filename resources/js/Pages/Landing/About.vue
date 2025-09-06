<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Domain from "@/Components/Main/Global/Domain.vue";
import FaqItem from "@/Components/Main/Global/FaqItem.vue";
import { getDomainName } from "@/utils/text";

const cards = [
    {
        title: "Top-Tier Games",
        description:
            "We offer a wide range of certified slots and original games, delivering big wins and a premium experience",
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M17.6445 5.41016H6.35041C3.75183 5.41016 1.64453 7.51745 1.64453 10.116C1.64453 10.7862 1.64453 15.093 1.64453 15.7631C1.64453 18.3617 3.75183 20.469 6.35041 20.469C10.1151 20.469 10.1151 17.6455 11.9975 17.6455C13.8798 17.6455 13.8798 20.469 17.6445 20.469C20.2431 20.469 22.3504 18.3617 22.3504 15.7631C22.3504 15.093 22.3504 10.7862 22.3504 10.116C22.3504 7.51745 20.2431 5.41016 17.6445 5.41016Z" fill="#298AFF"/>
<path d="M8.23323 12C8.17111 12 4.53064 12 4.46852 12C3.94899 12 3.52734 12.4216 3.52734 12.9412C3.52734 13.4607 3.94899 13.8824 4.46852 13.8824C4.53064 13.8824 8.17111 13.8824 8.23323 13.8824C8.75276 13.8824 9.1744 13.4607 9.1744 12.9412C9.1744 12.4216 8.75276 12 8.23323 12Z" fill="#298AFF"/>
<path d="M7.2886 14.8231C7.2886 14.761 7.2886 11.1205 7.2886 11.0584C7.2886 10.5388 6.86696 10.1172 6.34743 10.1172C5.8279 10.1172 5.40625 10.5388 5.40625 11.0584C5.40625 11.1205 5.40625 14.761 5.40625 14.8231C5.40625 15.3426 5.8279 15.7642 6.34743 15.7642C6.86696 15.7642 7.2886 15.3426 7.2886 14.8231Z" fill="#298AFF"/>
<path d="M17.6443 11.9995C18.1641 11.9995 18.5855 11.5782 18.5855 11.0584C18.5855 10.5386 18.1641 10.1172 17.6443 10.1172C17.1245 10.1172 16.7031 10.5386 16.7031 11.0584C16.7031 11.5782 17.1245 11.9995 17.6443 11.9995Z" fill="#298AFF"/>
<path d="M17.6443 15.7632C18.1641 15.7632 18.5855 15.3418 18.5855 14.822C18.5855 14.3022 18.1641 13.8809 17.6443 13.8809C17.1245 13.8809 16.7031 14.3022 16.7031 14.822C16.7031 15.3418 17.1245 15.7632 17.6443 15.7632Z" fill="#298AFF"/>
<path d="M19.5271 13.8824C20.0469 13.8824 20.4683 13.461 20.4683 12.9412C20.4683 12.4214 20.0469 12 19.5271 12C19.0073 12 18.5859 12.4214 18.5859 12.9412C18.5859 13.461 19.0073 13.8824 19.5271 13.8824Z" fill="#298AFF"/>
<path d="M15.7615 13.8824C16.2813 13.8824 16.7027 13.461 16.7027 12.9412C16.7027 12.4214 16.2813 12 15.7615 12C15.2417 12 14.8203 12.4214 14.8203 12.9412C14.8203 13.461 15.2417 13.8824 15.7615 13.8824Z" fill="#298AFF"/>
<path d="M6.35156 5.40993C6.35156 4.8904 6.77321 4.46875 7.29274 4.46875H9.17509C9.69462 4.46875 10.1163 4.8904 10.1163 5.40993H6.35156Z" fill="#298AFF"/>
<path d="M13.8789 5.41188C13.8789 4.89235 14.3006 4.4707 14.8201 4.4707H16.7024C17.222 4.4707 17.6436 4.89235 17.6436 5.41188H13.8789Z" fill="#298AFF"/>
</svg>`,
    },
    {
        title: "Fair Play & Security",
        description:
            "Our platform uses advanced encryption and certified algorithms for fair play, data protection, and fund security.",
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M2.44141 19.4619V14.0021C2.44141 13.3602 2.88282 12.8021 3.50776 12.6534L5.67717 12.1405C6.78588 11.8779 7.95011 11.9805 8.9967 12.4313L13.1181 14.2082C14.4254 14.772 15.0146 16.3005 14.4226 17.5955L14.7736 18.0558L19.1529 16.4925C19.984 16.1838 20.9054 16.6252 21.1859 17.4656C21.4325 18.2054 21.0974 19.0139 20.4 19.363L16.0489 21.5541C15.1821 21.987 14.1788 22.0586 13.2593 21.7527L7.48047 19.8261C6.65694 19.5513 5.76752 19.5494 4.94211 19.8186L3.5567 20.2713C3.00705 20.451 2.44141 20.0407 2.44141 19.4619Z" fill="#298AFF"/>
<path opacity="0.35" d="M20.3222 5.41016H12.7927C12.2751 5.41016 11.8516 5.83369 11.8516 6.35133V11.0572C11.8516 11.5749 12.2751 11.9984 12.7927 11.9984H20.3222C20.8398 11.9984 21.2633 11.5749 21.2633 11.0572V6.35133C21.2633 5.83369 20.8398 5.41016 20.3222 5.41016Z" fill="#298AFF"/>
<path d="M16.5616 1.64648C14.4816 1.64648 12.7969 3.33119 12.7969 5.41119H13.6383H14.6792C14.6792 4.3759 15.5263 3.52884 16.5616 3.52884C17.5969 3.52884 18.4439 4.3759 18.4439 5.41119H19.4096H20.3263C20.3263 3.33119 18.6416 1.64648 16.5616 1.64648Z" fill="#298AFF"/>
<path d="M16.5563 10.1165C17.336 10.1165 17.9681 9.48443 17.9681 8.70473C17.9681 7.92504 17.336 7.29297 16.5563 7.29297C15.7766 7.29297 15.1445 7.92504 15.1445 8.70473C15.1445 9.48443 15.7766 10.1165 16.5563 10.1165Z" fill="#298AFF"/>
</svg>`,
    },
    {
        title: "Lightning-Fast Payouts",
        description:
            "We provide instant payouts, giving you comfort, confidence, and no unnecessary waiting with every win",
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_139_58110)">
<path opacity="0.35" d="M23.2932 4.4707H10.1167C9.07673 4.4707 8.23438 5.31306 8.23438 6.35306V15.7648H23.2932V4.4707Z" fill="#298AFF"/>
<path d="M17.6457 13.881C19.465 13.881 20.9398 12.1955 20.9398 10.1163C20.9398 8.03708 19.465 6.35156 17.6457 6.35156C15.8264 6.35156 14.3516 8.03708 14.3516 10.1163C14.3516 12.1955 15.8264 13.881 17.6457 13.881Z" fill="#298AFF"/>
<path d="M11.0584 11.0581C11.5782 11.0581 11.9995 10.6368 11.9995 10.117C11.9995 9.59716 11.5782 9.17578 11.0584 9.17578C10.5386 9.17578 10.1172 9.59716 10.1172 10.117C10.1172 10.6368 10.5386 11.0581 11.0584 11.0581Z" fill="#298AFF"/>
<path d="M0.703125 10.1163L3.36477 7.45462C4.0716 6.7478 5.02877 6.35156 6.02736 6.35156H8.23254V13.9026L11.5314 12.568C12.3841 12.2226 13.361 12.4212 14.0114 13.0725C14.9554 14.0165 14.8961 15.5647 13.8824 16.4334L10.5055 19.3276C9.64618 20.0636 8.55065 20.4664 7.41936 20.4607L0.703125 20.4269V10.1163Z" fill="#298AFF"/>
</g>
<defs>
<clipPath id="clip0_139_58110">
<rect width="22.5882" height="22.5882" fill="white" transform="translate(0.703125 0.705078)"/>
</clipPath>
</defs>
</svg>
`,
    },
    {
        title: "24/7 Support",
        description:
            "Our support team is available around the clock and always ready to assist you in your preferred language",
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M20.324 15.7633C20.324 15.1469 19.9268 14.6283 19.3762 14.4363C19.3781 14.2518 19.3828 14.0739 19.3828 13.881C19.3828 9.72286 16.0115 6.35156 11.8534 6.35156C7.69528 6.35156 4.32399 9.72286 4.32399 13.881C4.32399 14.0664 4.33811 14.248 4.35128 14.4297C3.79034 14.616 3.38281 15.1393 3.38281 15.7633C3.38281 16.5426 4.01528 17.1751 4.79458 17.1751C4.89152 17.1751 4.98564 17.1657 5.07693 17.1469C6.29387 19.6673 8.86705 21.4104 11.8534 21.4104C16.9508 21.4104 18.6628 20.2744 19.1786 17.1478C19.8308 17.0236 20.324 16.4523 20.324 15.7633Z" fill="#298AFF"/>
<path d="M14.6769 4.47024C14.6769 3.43024 13.8346 2.58789 12.7946 2.58789H11.8534C7.17481 2.58789 3.38281 6.37989 3.38281 11.0585V13.882C3.38281 14.4015 3.80446 14.8232 4.32399 14.8232C4.84352 14.8232 5.26517 14.5474 5.26517 13.882C5.26517 12.3385 6.52917 11.0585 8.08869 11.0585H15.6181C17.1776 11.0585 18.4416 12.3225 18.4416 13.882C18.4416 14.4317 18.8633 14.8232 19.3828 14.8232C19.9023 14.8232 20.324 14.4015 20.324 13.882V11.0585C20.324 4.47024 14.6769 4.47024 14.6769 4.47024Z" fill="#298AFF"/>
<path d="M11.855 21.4112C12.8946 21.4112 13.7374 20.5684 13.7374 19.5288C13.7374 18.4892 12.8946 17.6465 11.855 17.6465C10.8154 17.6465 9.97266 18.4892 9.97266 19.5288C9.97266 20.5684 10.8154 21.4112 11.855 21.4112Z" fill="#298AFF"/>
<path d="M18.4398 15.7637V17.646C18.4398 18.686 17.5974 19.5284 16.5574 19.5284H11.8516V21.4107H16.5574C18.6365 21.4107 20.3222 19.7251 20.3222 17.646V15.7637H18.4398Z" fill="#298AFF"/>
<path d="M20.3238 17.6471H18.4414V12H20.3238C21.3638 12 22.2061 12.8424 22.2061 13.8824V15.7647C22.2061 16.8047 21.3638 17.6471 20.3238 17.6471Z" fill="#298AFF"/>
</svg>`,
    },
];
const faqItems = [
    {
        question: `Why is ${getDomainName()}'s VIP program the best one?`,
        answer: `${getDomainName()}'s VIP program stands out from competitors by offering progressive rewards that increase with your loyalty. Unlike other platforms, we provide exclusive bonuses, personalized support, higher withdrawal limits, and special event invitations that truly reward your dedication. Our VIP members also enjoy custom-tailored promotions and cashback offers that grow with your VIP level.`,
    },
    {
        question: "What is XP?",
        answer: `XP (Experience Points) is ${getDomainName()}'s loyalty currency that you earn through gameplay. Every bet you place contributes to your XP total, allowing you to progress through VIP levels naturally as you enjoy our games. XP accumulates automatically in your account and determines your position in our VIP hierarchy, unlocking increasingly valuable rewards as you advance.`,
    },
    {
        question: "What are the levels of VIP status and their benefits?",
        answer: `${getDomainName()} offers multiple VIP tiers, each with enhanced benefits: Bronze (entry level) provides basic cashback and weekly bonuses; Silver adds higher withdrawal limits and priority support; Gold includes personalized offers and exclusive tournament access; Platinum features dedicated account managers and VIP-only events; while Diamond (our highest tier) offers custom rewards packages, instant withdrawals, and invitation-only experiences. Each level progressively improves your rewards and platform privileges.`,
    },
    {
        question: "I need to make a deposit in the equivalent of XP points for each status?",
        answer: `No, you don't need to make deposits equivalent to XP points. XP is earned naturally through your gameplay on ${getDomainName()}. Every wager you place contributes to your XP total regardless of whether you win or lose. Your VIP status advances automatically as you accumulate XP through regular play, with no minimum deposit requirements tied directly to VIP progression.`,
    },
    {
        question: "How does VIP status affect my chances of winning?",
        answer: `Your VIP status has absolutely no impact on your chances of winning at ${getDomainName()}. All games operate with the same fair and transparent odds regardless of your VIP level. What VIP status does provide are enhanced rewards, bonuses, and services that improve your overall experience and value, but the fundamental game mechanics and winning probabilities remain identical for all players across all VIP tiers.`,
    },
];
const certificates = [
    {
        title: "Reliable protection of user data and funds",
        icon: `<svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M21.125 27.5423H4.875C2.63115 27.5423 0.8125 25.7237 0.8125 23.4798V12.6465C0.8125 10.4026 2.63115 8.58398 4.875 8.58398H21.125C23.3689 8.58398 25.1875 10.4026 25.1875 12.6465V23.4798C25.1875 25.7237 23.3689 27.5423 21.125 27.5423Z" fill="#298AFF"/>
<path d="M7.58333 8.58398C7.58333 5.59263 10.0086 3.16732 13 3.16732C15.9914 3.16732 18.4167 5.59263 18.4167 8.58398H21.125C21.125 4.09628 17.4877 0.458984 13 0.458984C8.51229 0.458984 4.875 4.09628 4.875 8.58398H7.58333Z" fill="#298AFF"/>
<path d="M13.0013 15.3555C11.5049 15.3555 10.293 16.5674 10.293 18.0638C10.293 19.5602 11.5049 20.7721 13.0013 20.7721C14.4977 20.7721 15.7096 19.5602 15.7096 18.0638C15.7096 16.5674 14.4977 15.3555 13.0013 15.3555Z" fill="#298AFF"/>
</svg>
`,
    },
    {
        title: "Transparency of game processes",
        icon: `<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.35" d="M27.7135 8.87435H23.368C22.8088 7.29945 21.3205 6.16602 19.5547 6.16602H7.36719C5.12333 6.16602 3.30469 7.98466 3.30469 10.2285V25.1243C3.30469 27.3682 5.12333 29.1868 7.36719 29.1868H19.5547C21.3205 29.1868 22.8088 28.0534 23.368 26.4785H27.7135C28.7955 26.4785 29.673 25.601 29.673 24.519V10.8338C29.673 9.75185 28.7955 8.87435 27.7135 8.87435Z" fill="#298AFF"/>
<path d="M8.04688 14.291C9.1687 14.291 10.0781 13.3816 10.0781 12.2598C10.0781 11.1379 9.1687 10.2285 8.04688 10.2285C6.92505 10.2285 6.01562 11.1379 6.01562 12.2598C6.01562 13.3816 6.92505 14.291 8.04688 14.291Z" fill="#298AFF"/>
<path d="M18.8789 14.291C20.0007 14.291 20.9102 13.3816 20.9102 12.2598C20.9102 11.1379 20.0007 10.2285 18.8789 10.2285C17.7571 10.2285 16.8477 11.1379 16.8477 12.2598C16.8477 13.3816 17.7571 14.291 18.8789 14.291Z" fill="#298AFF"/>
<path d="M26.3255 6.16602H19.5547C21.7985 6.16602 23.6172 7.98466 23.6172 10.2285V25.1243C23.6172 27.3682 21.7985 29.1868 19.5547 29.1868H26.3255C28.5694 29.1868 30.388 27.3682 30.388 25.1243V10.2285C30.388 7.98466 28.5694 6.16602 26.3255 6.16602ZM26.3255 14.291C25.578 14.291 24.9714 13.381 24.9714 12.2598C24.9714 11.1385 25.578 10.2285 26.3255 10.2285C27.073 10.2285 27.6797 11.1385 27.6797 12.2598C27.6797 13.381 27.073 14.291 26.3255 14.291ZM27.6797 25.1243C26.9322 25.1243 26.3255 24.2143 26.3255 23.0931C26.3255 21.9718 26.9322 21.0618 27.6797 21.0618C28.4272 21.0618 29.0339 21.9718 29.0339 23.0931C29.0339 24.2143 28.4272 25.1243 27.6797 25.1243Z" fill="#298AFF"/>
<path d="M8.04688 25.125C9.1687 25.125 10.0781 24.2156 10.0781 23.0938C10.0781 21.9719 9.1687 21.0625 8.04688 21.0625C6.92505 21.0625 6.01562 21.9719 6.01562 23.0938C6.01562 24.2156 6.92505 25.125 8.04688 25.125Z" fill="#298AFF"/>
<path d="M18.8789 25.125C20.0007 25.125 20.9102 24.2156 20.9102 23.0938C20.9102 21.9719 20.0007 21.0625 18.8789 21.0625C17.7571 21.0625 16.8477 21.9719 16.8477 23.0938C16.8477 24.2156 17.7571 25.125 18.8789 25.125Z" fill="#298AFF"/>
</svg>
`,
    },
    {
        title: "Certified game mechanics & RNGs",
        icon: `<svg width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M31.1648 24.7032L26.6608 20.1992C26.8978 21.5466 26.4455 23.1283 25.3094 24.2644C24.0392 25.5346 22.2097 25.9571 20.7756 25.5076C20.5251 25.9869 20.1541 26.4216 19.7031 26.7832L24.394 31.474C25.1848 32.2648 26.5376 31.8911 26.8098 30.8051L27.2404 29.0812C27.4286 28.3269 28.0177 27.7379 28.772 27.5496L30.4958 27.119C31.5819 26.8468 31.9556 25.494 31.1648 24.7032Z" fill="#298AFF"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.21938 24.7032L6.72334 20.1992C6.48636 21.5466 6.93865 23.1283 8.07479 24.2644C9.345 25.5346 11.1745 25.9571 12.6085 25.5076C12.8591 25.9869 13.2301 26.4216 13.681 26.7832L8.99021 31.474C8.19938 32.2648 6.84656 31.8911 6.57438 30.8051L6.14375 29.0812C5.95552 28.3269 5.36646 27.7379 4.61219 27.5496L2.88834 27.119C1.80229 26.8468 1.42854 25.494 2.21938 24.7032Z" fill="#298AFF"/>
<path opacity="0.35" fill-rule="evenodd" clip-rule="evenodd" d="M12.6072 5.78544C13.3033 4.4543 14.8958 3.45898 16.6914 3.45898C18.487 3.45898 20.0795 4.4543 20.7756 5.78544C22.2083 5.33586 24.0391 5.75836 25.3093 7.02857C26.5795 8.29878 27.002 10.1283 26.5524 11.5623C27.8836 12.2584 28.8789 13.8509 28.8789 15.6465C28.8789 17.4421 27.8836 19.0346 26.5524 19.7306C27.002 21.1634 26.5795 22.9942 25.3093 24.2644C24.0391 25.5346 22.2096 25.9571 20.7756 25.5075C20.0795 26.8387 18.487 27.834 16.6914 27.834C14.8958 27.834 13.3033 26.8387 12.6072 25.5075C11.1745 25.9571 9.3437 25.5346 8.07349 24.2644C6.80328 22.9942 6.38078 21.1647 6.83036 19.7306C5.49922 19.0346 4.50391 17.4421 4.50391 15.6465C4.50391 13.8509 5.49922 12.2584 6.83036 11.5623C6.38078 10.1296 6.80328 8.29878 8.07349 7.02857C9.3437 5.75836 11.1732 5.33586 12.6072 5.78544Z" fill="#298AFF"/>
<path d="M15.3389 21.0615C14.9922 21.0615 14.6455 20.9288 14.3815 20.6648L10.319 16.6023C9.78951 16.0728 9.78951 15.217 10.319 14.6875C10.8485 14.158 11.7043 14.158 12.2338 14.6875L15.3389 17.7926L21.1523 11.9791C21.6818 11.4497 22.5376 11.4497 23.0671 11.9791C23.5966 12.5086 23.5966 13.3645 23.0671 13.8939L16.2963 20.6648C16.0322 20.9288 15.6855 21.0615 15.3389 21.0615Z" fill="#298AFF"/>
</svg>`,
    },
];
</script>

<template>
    <MainLayout>
        <div class="container flex flex-col gap-12 mx-auto">
            <div class="bg-secondary-sidebar about_bg flex justify-between items-center p-6 w-full rounded-2xl">
                <div class="max-md:text-center flex flex-col gap-3">
                    <Domain class="max-md:justify-center" />
                    <div class="flex flex-col gap-4">
                        <h1 class="text-3xl font-bold text-white">
                            About us
                        </h1>
                        <p class="text-white/50 max-w-[570px]">
                            Our reputation is built on safety, transparency and
                            honesty. We are committed to maintaining high
                            standards, confirming our licensed operations and
                            providing confidence in fair and safe gaming
                        </p>
                    </div>
                </div>
            </div>
            <div class="max-md:flex-col flex relative justify-between items-center">
                <div class="flex flex-col gap-4 max-w-[780px]">
                    <p class="text-[22px] font-bold">
                        Who We Are?
                    </p>
                    <p class="text-white/75 max-w-[760px]">
                        As of 2019, {{ getDomainName() }} provides a cutting-edge online casino
                        gaming experience, supporting both fiat currencies and a
                        wide range of cryptocurrencies, including Bitcoin.
                        Celebrating 6 years of success, we continue to improve
                        {{ getDomainName() }} to offer you even more exciting winnings and an
                        unrivaled gaming experience. We are constantly updating
                        our platform, making betting on the best online games at
                        {{ getDomainName() }} even more accessible and exciting!
                    </p>
                </div>
                <div class="md:absolute flex right-0 -top-20 justify-end w-full">
                    <img src="/assets/images/info/games.png" alt="about" class="max-h-[520px] max-lg:hidden max-w-[450px] object-cover w-full h-full" />
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <p class="text-[22px] font-bold text-white">Why Choose Medium?</p>
                <div class="max-lg:grid-cols-2 max-md:grid-cols-1 grid grid-cols-4 gap-5 items-stretch">
                    <div v-for="card in cards" :key="card.title" class="card_about">
                        <div class="flex flex-col gap-4">
                            <div class="bg-primary/10 flex justify-center items-center w-12 h-12 rounded-xl">
                                <div v-html="card.icon"></div>
                            </div>
                            <p class="text-xl font-bold text-white">
                                {{ card.title }}
                            </p>
                            <p class="text-white/75">{{ card.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-md:flex-col flex gap-12 items-center">
                <div class="overflow-hidden max-w-[520px]">
                    <img src="/assets/images/info/coins.png" alt="about" class="object-cover w-full h-full" />
                </div>
                <div class="flex flex-col flex-1 gap-3 w-full">
                    <p class="gap-4 text-[22px] font-bold text-white">
                        Play Your Way
                    </p>
                    <p class="text-white/75">
                        Whether you're a beginner or a high roller, Domain
                        Casino offers an exciting and reliable gaming experience
                        for every player. Get instant access from any device and
                        enjoy playing anytime, anywhere. Feel the thrill,
                        comfort, and control in every bet. Ready to play your
                        way?
                    </p>
                </div>
            </div>
            <div class="bg-secondary-sidebar max-md:flex-col flex gap-8 p-8 rounded-xl">
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col gap-8 h-full">
                        <div class="flex flex-col gap-3">
                            <p class="text-[22px] font-bold text-white">
                                Certificate of Achievement
                            </p>
                            <p class="text-white/75">
                                Domain Casino operates under a license issued by
                                the Gaming Control Board (GCB),<br> which confirms
                                our commitment to international standards of
                                safety and fair play.
                            </p>
                        </div>
                        <div class="flex flex-col gap-3 h-full">
                            <p class="font-bold text-[22px]">
                                GPL license provides
                            </p>
                            <div class="max-md:grid-cols-1 grid grid-cols-3 gap-3">
                                <div v-for="certificate in certificates" class="bg-secondary flex gap-4 items-center p-4 rounded-xl">
                                    <div class="bg-primary/10 flex flex-shrink-0 justify-center items-center w-[52px] h-[52px] rounded-xl">
                                        <div v-html="certificate.icon"></div>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <p class="text-white">
                                            {{ certificate.title }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white/75 max-w-[660px]">The license confirms our legitimate activities and guarantees users an honest, secure<br> and controlled gaming experience, both in classic games and in the crypto environment.</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <img src="/assets/images/info/david_img.png" alt="david" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col gap-2">
                                <p class="font-bold leading-none text-white uppercase">David Lopez</p>
                                <p class="text-white/50 font-medium uppercase">
                                    One of the founders of {{ getDomainName() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="/assets/images/license/license.png" class="max-w-[310px] rounded-2xl">
            </div>
            <div class="flex flex-col gap-3 h-full">
                <div class="flex z-50 flex-col gap-4 justify-center items-center text-center">
                    <h2 class="text-[22px] font-bold">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-white/75">
                        Here, you’ll find answers to the most common questions
                        about our platform, games, payments, and more
                    </p>
                </div>
                <FaqItem v-for="item in faqItems" :key="item.question" :question="item.question" :answer="item.answer" />
                <div class="bg-primary/10 max-md:justify-center max-md:flex-col max-md:gap-4 flex justify-between items-center px-4 py-3 rounded-3xl">
                    <div class="flex flex-col">
                        <p class="font-bold">Any questions left?</p>
                        <p class="text-[#81BAFF]">Our team of professionals is ready to help you 24/7 - write to us</p>
                    </div>
                    <button class="btn btn-primary before:hidden max-md:w-full max-md:justify-center w-fit z-50 px-6 rounded-2xl shadow-none">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.3916 14.2372L15.7166 16.8706C15.7999 17.5622 15.0582 18.0456 14.4666 17.6872L11.5832 15.9706C11.3832 15.8539 11.3332 15.6039 11.4416 15.4039C11.8582 14.6372 12.0832 13.7706 12.0832 12.9039C12.0832 9.85391 9.46658 7.37057 6.24991 7.37057C5.59158 7.37057 4.94991 7.47057 4.34991 7.67057C4.04158 7.77057 3.74158 7.48724 3.81658 7.17057C4.57491 4.13724 7.49158 1.87891 10.9749 1.87891C15.0416 1.87891 18.3332 4.95391 18.3332 8.74557C18.3332 10.9956 17.1749 12.9872 15.3916 14.2372Z" fill="#E8EDFF" />
                            <path d="M10.8334 12.9034C10.8334 13.8951 10.4667 14.8118 9.85008 15.5368C9.02508 16.5368 7.71675 17.1785 6.25008 17.1785L4.07508 18.4701C3.70841 18.6951 3.24175 18.3868 3.29175 17.9618L3.50008 16.3201C2.38341 15.5451 1.66675 14.3034 1.66675 12.9034C1.66675 11.4368 2.45008 10.1451 3.65008 9.37845C4.39175 8.89512 5.28341 8.62012 6.25008 8.62012C8.78341 8.62012 10.8334 10.5368 10.8334 12.9034Z" fill="#E8EDFF" />
                        </svg>

                        Chat with support
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.card_about {
    @apply flex flex-col gap-4 p-6;
    border-radius: 24px;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.04);
    background: radial-gradient(81.71% 58.59% at 0% 0%,
            rgba(41, 138, 255, 0.14) 0%,
            rgba(41, 138, 255, 0) 100%),
        rgba(105, 111, 156, 0.11);
    backdrop-filter: blur(30px);
}
</style>
