<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Domain from "@/Components/Main/Global/Domain.vue";
import FaqItem from "@/Components/Main/Global/FaqItem.vue";
import { getDomainName } from "@/utils/text";
import { defineProps, ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    type: {
        type: String,
        default: 'privacy'
    }
})
const isMobile = ref(false);

onMounted(() => {
    isMobile.value = window.innerWidth < 768;
});

const getImage = () => {
    if (isMobile.value) {
        return `/assets/images/rules/${props.type}_mobile.png`;
    }
    return `/assets/images/rules/${props.type}.png`;
}


const getTitle = () => {
    switch (props.type) {
        case 'privacy':
            return 'Privacy Policy';
        case 'terms':
            return 'Terms of Service';
        case 'aml':
            return 'AML Policy';
    }
}

const getContent = () => {
    switch (props.type) {
        case 'aml':
            return [
                {
                    title: 'Company',
                    description: 'Medium Rare N.V. ("Domain" or the "Company"), registered in accordance with the laws of Curaçao, company number 151486, holds a valid Certificate of Operation. The Company has submitted an application (OGL/2024/1451/0918) for a gambling license to the Curaçao Gaming Control Board. In accordance with the transitional period stipulated in the National Ordinance on Gambling (Landsverordening op de Kansspelen, P.B. 2024, No. 157), Domain is entitled to continue its operations based on the current certificate. As part of its global operations, Domain has established compliance measures commensurate with its services and products that are reasonably designed to deter and detect illicit activity on its platform. Such measures include onboarding and compliance screenings of its customers and transaction actionbased controls.',
                    ul: {

                    }
                },
                {
                    title: 'Company Policy Statement',
                    description: 'Domain is not a financial institution within the meaning of applicable law of Curaçao and is accordingly not directly subject to the statutes and regulations applicable to certain financial institutions, money transfer, or virtual asset service providers. However, in accordance with the 2016 Regulations for AntiMoney Laundering and Combating the Financing of Terrorism ("AML/CFT") applicable for the Curaçao jurisdiction as provided by the Curaçao Gaming Control Board, Domain expressly prohibits and rejects the use of Domain products for any form of illicit activity, including money laundering, terrorist financing or trade sanctions violations, consistent with various national anti-money laundering ("AML") laws, regulations and norms. Domain continues to monitor norm setting parameters promulgated by the Financial Action Task Force ("FATF") and certain gaming trade groups in addition to the Curaçao Gaming Control Board and will take necessary action as it deems appropriate to reflect changes in law. Domain\'s intention is to follow global best practices in guarding against Domain products being used to facilitate such activities.',
                    ul: {
                        items: [
                            'Adoption of a written policy, and procedures and controls, reasonably designed to guard against money laundering, terrorist financing and trade sanctions violations;',
                            'Where appropriate, designation of a compliance officer to oversee the implementation of the policy, procedures and controls;',
                            'Provision of related education and training to relevant personnel;',
                            'Independent reviews, monitoring and maintenance of the policy, procedures and controls.'
                        ]
                    }
                },
                {
                    title: 'Definitions',
                    description: 'The following defined terms are widely used in the industry:',
                    ul: {
                        items: [
                            'Money Laundering: The process of making illegally-gained proceeds appear legal. This process is generally broken down into three steps: placement, layering and integration.',
                            'Placement: The process of placing unlawful proceeds into traditional financial institutions, through deposits or other avenues.',
                            'Layering: The process of separating proceeds of criminal activity from their origin through the use of layers of complex financial transactions, such as converting cash into traveler\'s checks, money orders, wire transfers, letters of credit, stocks, bonds or purchasing assets.',
                            'Integration: Using apparently legitimate transactions to disguise the illicit proceeds, allowing the laundered funds to be distributed back to the criminal; integrating the now clean money back into normal use.',
                            'Suspicious Activity: Activity conducted by a user or non-user using the institution where there are indications that the persons engaging in the transaction may be doing so for fraudulent or illegal purposes.',
                            'Sanctions: Sanctions are activities conducted by the international community to prohibit or constrain activities of the target of the sanctions.'
                        ]
                    }
                },
                {
                    title: 'Governance and Oversight',
                    description: 'Domain has a specially appointed Chief Compliance Officer (CCO) responsible for ensuring compliance with AML requirements. His task is not only to coordinate the implementation of relevant policies and programs, but also to develop new initiatives, interact with stakeholders to improve AML policies, track changes in legislation, and respond promptly to any suspicious activity. To maintain a high level of staff awareness, Domain regularly conducts AML training for all its employees.'
                },
                {
                    title: 'Know Your Customer and Transaction Monitoring',
                    description: 'Domain will apply appropriate user due diligence and ongoing monitoring measures required by law using an automated system. Domain will endeavor to prevent users from engaging in illicit or otherwise unauthorized activity. Domain uses a combination of its software development and other service agreements, which are enforced through internal operational features to ensure that it complies with the applicable law.'
                }
            ];
        case 'privacy':
            return [
                {
                    title: 'Demotopg and Bitget signed a cooperation agreement',
                    description: `Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum; lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?

                    Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad elit. Maecenas class arcu quam molestie auctor fermentum dolor`,
                },
                {
                    title: 'Demotopg and Bitget signed a cooperation agreement',
                    description: `Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum; lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?

                    Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad elit. Maecenas class arcu quam molestie auctor fermentum dolor`,
                },
                {
                    title: 'Demotopg and Bitget signed a cooperation agreement',
                    description: `Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum; lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?

                    Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad elit. Maecenas class arcu quam molestie auctor fermentum dolor`,
                }
            ];
        case 'terms':
            return [
                {
                    title: 'Demotopg and Bitget signed a cooperation agreement',
                    description: `Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum; lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?

                    Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad elit. Maecenas class arcu quam molestie auctor fermentum dolor`,
                },
                {
                    title: 'Demotopg and Bitget signed a cooperation agreement',
                    description: `Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum; lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?

                    Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad elit. Maecenas class arcu quam molestie auctor fermentum dolor`,
                },
                {
                    title: 'Demotopg and Bitget signed a cooperation agreement',
                    description: `Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum; lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?

                    Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad elit. Maecenas class arcu quam molestie auctor fermentum dolor`,
                }
            ];
    }
}

</script>

<template>
    <MainLayout>
        <div class="container flex flex-col gap-12 mx-auto">
            <div :style="`background-image: url('${getImage()}')`" class="bg-secondary-sidebar bg-bottom md:min-h-[250px] min-h-[330px] rules_bg flex max-md:flex-col justify-between items-center p-6 w-full rounded-2xl">
                <div class="flex flex-col gap-2">
                    <Domain />
                    <div class="flex flex-col gap-4">
                        <h1 class="text-3xl font-bold text-white">
                            {{ getTitle() }}
                        </h1>

                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2.5 w-full">
                <div class="max-md:flex-col max-md:items-start flex gap-4 items-center w-full uppercase">
                    <Link href="/more/rules/privacy" :class="{ 'active': type === 'privacy' }" class="btn btn-swiper max-md:w-full">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.9599 1.66797H8.04326C7.17659 1.66797 6.46826 2.36797 6.46826 3.23464V4.01797C6.46826 4.88464 7.16826 5.58464 8.03493 5.58464H11.9599C12.8266 5.58464 13.5266 4.88464 13.5266 4.01797V3.23464C13.5349 2.36797 12.8266 1.66797 11.9599 1.66797Z" fill="currentColor" />
                        <path d="M14.3657 4.01689C14.3657 5.34189 13.2824 6.42523 11.9574 6.42523H8.04072C6.71572 6.42523 5.63239 5.34189 5.63239 4.01689C5.63239 3.55023 5.13239 3.25856 4.71572 3.47523C3.54072 4.10023 2.74072 5.34189 2.74072 6.76689V14.6086C2.74072 16.6586 4.41572 18.3336 6.46572 18.3336H13.5324C15.5824 18.3336 17.2574 16.6586 17.2574 14.6086V6.76689C17.2574 5.34189 16.4574 4.10023 15.2824 3.47523C14.8657 3.25856 14.3657 3.55023 14.3657 4.01689ZM10.3157 14.1252H6.66572C6.32406 14.1252 6.04072 13.8419 6.04072 13.5002C6.04072 13.1586 6.32406 12.8752 6.66572 12.8752H10.3157C10.6574 12.8752 10.9407 13.1586 10.9407 13.5002C10.9407 13.8419 10.6574 14.1252 10.3157 14.1252ZM12.4991 10.7919H6.66572C6.32406 10.7919 6.04072 10.5086 6.04072 10.1669C6.04072 9.82523 6.32406 9.54189 6.66572 9.54189H12.4991C12.8407 9.54189 13.1241 9.82523 13.1241 10.1669C13.1241 10.5086 12.8407 10.7919 12.4991 10.7919Z" fill="currentColor" />
                    </svg>
                    Privacy policy
                    </Link>
                    <Link href="/more/rules/terms" :class="{ 'active': type === 'terms' }" class="btn btn-swiper max-md:w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                        <path d="M11.3333 0.667969H4.66667C1.75 0.667969 0.5 2.33464 0.5 4.83464V13.168C0.5 15.668 1.75 17.3346 4.66667 17.3346H11.3333C14.25 17.3346 15.5 15.668 15.5 13.168V4.83464C15.5 2.33464 14.25 0.667969 11.3333 0.667969ZM4.66667 9.20963H8C8.34167 9.20963 8.625 9.49297 8.625 9.83463C8.625 10.1763 8.34167 10.4596 8 10.4596H4.66667C4.325 10.4596 4.04167 10.1763 4.04167 9.83463C4.04167 9.49297 4.325 9.20963 4.66667 9.20963ZM11.3333 13.793H4.66667C4.325 13.793 4.04167 13.5096 4.04167 13.168C4.04167 12.8263 4.325 12.543 4.66667 12.543H11.3333C11.675 12.543 11.9583 12.8263 11.9583 13.168C11.9583 13.5096 11.675 13.793 11.3333 13.793ZM13.4167 6.70964H11.75C10.4833 6.70964 9.45833 5.68464 9.45833 4.41797V2.7513C9.45833 2.40964 9.74167 2.1263 10.0833 2.1263C10.425 2.1263 10.7083 2.40964 10.7083 2.7513V4.41797C10.7083 4.99297 11.175 5.45964 11.75 5.45964H13.4167C13.7583 5.45964 14.0417 5.74297 14.0417 6.08464C14.0417 6.4263 13.7583 6.70964 13.4167 6.70964Z" fill="currentColor" />
                    </svg>
                    Terms of Service
                    </Link>
                    <Link href="/more/rules/aml" :class="{ 'active': type === 'aml' }" class="btn btn-swiper max-md:w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M12.4762 10.625H11.8345H7.94287V12.9833H9.03454H12.4762C13.2679 12.9833 13.9179 12.45 13.9179 11.8C13.9179 11.15 13.2679 10.625 12.4762 10.625Z" fill="currentColor" />
                        <path d="M9.99984 1.66797C5.39984 1.66797 1.6665 5.4013 1.6665 10.0013C1.6665 14.6013 5.39984 18.3346 9.99984 18.3346C14.5998 18.3346 18.3332 14.6013 18.3332 10.0013C18.3332 5.4013 14.5998 1.66797 9.99984 1.66797ZM12.4748 14.2346H11.0998V15.418C11.0998 15.7596 10.8165 16.043 10.4748 16.043C10.1332 16.043 9.84984 15.7596 9.84984 15.418V14.2346H9.03317H8.8415V15.418C8.8415 15.7596 8.55817 16.043 8.2165 16.043C7.87484 16.043 7.5915 15.7596 7.5915 15.418V14.2346H7.3165H5.87484C5.53317 14.2346 5.24984 13.9513 5.24984 13.6096C5.24984 13.268 5.53317 12.9846 5.87484 12.9846H6.6915V10.0013V7.01797H5.87484C5.53317 7.01797 5.24984 6.73464 5.24984 6.39297C5.24984 6.0513 5.53317 5.76797 5.87484 5.76797H7.3165H7.5915V4.58464C7.5915 4.24297 7.87484 3.95964 8.2165 3.95964C8.55817 3.95964 8.8415 4.24297 8.8415 4.58464V5.76797H9.03317H9.84984V4.58464C9.84984 4.24297 10.1332 3.95964 10.4748 3.95964C10.8165 3.95964 11.0998 4.24297 11.0998 4.58464V5.76797H11.8332C13.1248 5.76797 14.2665 6.9013 14.2665 8.2013C14.2665 8.75964 14.0665 9.26797 13.7498 9.68464C14.5915 10.093 15.1665 10.893 15.1665 11.818C15.1665 13.143 13.9582 14.2346 12.4748 14.2346Z" fill="currentColor" />
                        <path d="M13.0179 8.19115C13.0179 7.64115 12.5012 7.00781 11.8345 7.00781H9.03454H7.94287V9.36615H11.8345C12.4845 9.37448 13.0179 8.84115 13.0179 8.19115Z" fill="currentColor" />
                    </svg>
                    AML Policy
                    </Link>
                </div>
                <div class="bg-secondary-sidebar flex flex-col gap-11 p-8 rounded-2xl">
                    <div class="flex flex-col gap-4" v-for="item in getContent()" :key="item.title">
                        <h2 class="text-2xl font-bold text-white">
                            {{ item.title }}
                        </h2>
                        <p class="text-white/75">
                            {{ item.description }}
                        </p>
                        <ul v-if="item?.ul?.items" class="text-white/75 flex flex-col gap-1 list-disc list-inside">
                            <li v-for="item in item?.ul?.items" :key="item">
                                {{ item }}
                            </li>
                        </ul>
                    </div>
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

.rules_bg {
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;


}


</style>
