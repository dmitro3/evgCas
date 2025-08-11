<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Domain from "@/Components/Main/Global/Domain.vue";
const licenses = [
    {
        title: "GCB",
        description:
            "Domain is owned and operated by Medium Rare N.V., registration number: 151486, registered address: Korporaalweg 10, Willemstad, Curaçao. Payment agent company is Medium Rare Limited with address 7-9 Riga Feraiou, LIZANTIA COURT, Office 310, Agioi Omologites, 1087 Nicosia, Cyprus and Registration number: HE 410775",
        image: "/assets/images/license/gcb.png",
    },
    {
        title: "SSL Secured",
        description:
            "Domain, a leading cryptocasino, has partnered with SSL Secured to ensure maximum protection of user data. SSL Secured's advanced SSL encryption technology will securely protect transactions and players' personal information. This partnership will reinforce Domain's reputation as a secure platform that meets high industry standards. Domain is committed to providing users with a comfortable and secure gaming environment",
        image: "/assets/images/license/ssl.png",
    },
    {
        title: "GDPR",
        description:
            "Domain enhances platform reliability by ensuring GDPR compliance with GDPR Compliance Solutions. GDPR Compliance Solutions' expert support ensures user data protection and compliance. This partnership reaffirms Domain's commitment to security and transparency in the handling of personal information",
        image: "/assets/images/license/gdpr.png",
    },
    {
        title: "UKGC",
        description:
            "Domain complies with strict UKGC requirements demonstrating a commitment to a fair and safe gaming environment for UK users",
        image: "/assets/images/license/ujgc.png",
    },
    {
        title: "Blockchain",
        description:
            "Domain has partnered with Blockchain.com to integrate advanced blockchain solutions that provide enhanced security and transparency in financial transactions. This partnership allows Domain to offer users more secure and convenient ways to manage crypto assets, demonstrating an innovative approach to crypto gambling",
        image: "/assets/images/license/blockchain.png",
    },
    {
        title: "Sumsub",
        description:
            "Domain, a recognized cryptocasino, increases the reliability of the platform by partnering with Sumsub, an expert in KYC/AML. Sumsub's automated verification will speed up the process for Domain users, providing fast and convenient access to the platform. This will ensure a secure and transparent gaming environment through a comprehensive approach to risk assessment and transaction monitoring. Domain is committed to creating the most comfortable and secure environment possible, building trust and competitiveness",
        image: "/assets/images/license/sumsub.png",
    },
    {
        title: "FinCEN",
        description:
            "Domain, strictly complies with FinCEN requirements by implementing rigorous customer identification and verification procedures, and implements comprehensive measures to prevent illegal financial transactions. This approach guarantees users a safe and secure gaming environment",
        image: "/assets/images/license/fincen.png",
    },
    {
        title: "Crypto Gambling",
        description:
            "Domain and Crypto Gambling are teaming up to revolutionize crypto gambling! The integration of Crypto Gambling's crypto technology will provide Domain with instant transactions, enhanced security and an expanded selection of games. This partnership will strengthen Domain's market leadership, attract new players and increase player loyalty. The joint goal of the companies is to create a reliable and innovative platform for cryptocurrency gambling",
        image: "/assets/images/license/gambling.png",
    },
];
</script>

<template>
    <MainLayout>
        <div class="container flex flex-col gap-12 mx-auto">
            <div
                class="bg-secondary-sidebar licenses-bg flex justify-between items-center p-6 w-full rounded-2xl"
            >
                <div class="flex flex-col gap-4">
                    <Domain :classNames="'!justify-center'" />
                    <div class="flex flex-col gap-4">
                        <h1 class="text-3xl font-semibold text-white">
                            Licenses & Security
                        </h1>
                        <p class="text-white/75 max-w-[570px]">
                            Transparency and fairness of the gaming process are
                            our top priorities. We have all the necessary
                            licenses to operate cryptocasino at the highest
                            level of security, so that your data and funds are
                            safely protected
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="lg:grid-cols-4 max-md:grid-cols-1 grid grid-cols-2 gap-2.5"
            >
                <div
                    v-for="license in licenses"
                    :key="license.title"
                    class="bg-secondary-sidebar flex flex-col gap-4 items-center p-6 rounded-2xl"
                >
                    <div
                        class="min-h-[84px] max-h-[84px] flex items-center justify-center"
                    >
                        <img
                            :src="license.image"
                            :alt="license.title"
                            class="object-contain w-full h-full"
                        />
                    </div>
                    <div class="flex flex-col gap-4 items-center text-center">
                        <h1 class="text-2xl font-semibold text-white">
                            {{ license.title }}
                        </h1>
                        <p class="text-white/75 max-w-[570px]">
                            {{ license.description }}
                        </p>
                    </div>
                </div>

            </div>
            <div class="bg-primary/15 flex flex-col gap-6 justify-center items-center p-6 w-full rounded-2xl">
                    <div class="flex flex-col gap-6 items-center p-4 w-full rounded-2xl">
                        <div class="bg-primary/10 w-fit flex justify-center items-center p-6 rounded-2xl">
                            <svg
                            width="57"
                            height="56"
                            viewBox="0 0 57 56"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                opacity="0.35"
                                d="M24.9974 4.66602C14.0447 4.66602 5.16406 13.5467 5.16406 24.4993C5.16406 27.6564 5.92006 30.629 7.23373 33.2797L5.24106 41.2504C4.78606 43.0657 6.43106 44.7107 8.2464 44.2557L16.2171 42.263C18.8677 43.5767 21.8404 44.3327 24.9974 44.3327C35.9501 44.3327 44.8307 35.452 44.8307 24.4993C44.8307 13.5467 35.9501 4.66602 24.9974 4.66602Z"
                                fill="#81BAFF"
                            />
                            <path
                                d="M48.7922 36.3926L51.7579 48.2506C52.2129 50.0659 50.5679 51.7109 48.7525 51.2559L36.8945 48.2902L48.7922 36.3926Z"
                                fill="#81BAFF"
                            />
                            <path
                                d="M42.0656 14.4336C43.8133 17.3853 44.8329 20.8199 44.8329 24.4996C44.8329 35.4523 35.9523 44.3329 24.9996 44.3329C21.3199 44.3329 17.8853 43.3133 14.9336 41.5656C18.3846 47.4059 24.7266 51.3329 31.9996 51.3329C42.9523 51.3329 51.8329 42.4523 51.8329 31.4996C51.8329 24.2266 47.9059 17.8846 42.0656 14.4336Z"
                                fill="#81BAFF"
                            />
                        </svg>
                        </div>

                        <div class="flex flex-col gap-2 items-center w-full">
                            <p class="text-2xl font-bold">
                                Any questions left?
                            </p>
                            <p class="text-[#81BAFF]">
                                Lorem ipsum odor amet, consectetuer adipiscing
                                elit
                            </p>

                        </div>
                        <button class="btn btn-primary justify-center py-4 w-full">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M15.3913 14.0243L15.7163 16.6577C15.7997 17.3493 15.058 17.8327 14.4663 17.4743L11.583 15.7577C11.383 15.641 11.333 15.391 11.4413 15.191C11.858 14.4243 12.083 13.5577 12.083 12.691C12.083 9.64101 9.46633 7.15768 6.24967 7.15768C5.59133 7.15768 4.94967 7.25768 4.34967 7.45768C4.04133 7.55768 3.74133 7.27435 3.81633 6.95768C4.57467 3.92435 7.49133 1.66602 10.9747 1.66602C15.0413 1.66602 18.333 4.74102 18.333 8.53268C18.333 10.7827 17.1747 12.7743 15.3913 14.0243Z"
                                        fill="#E8EDFF"
                                    />
                                    <path
                                        d="M10.8346 12.6915C10.8346 13.6832 10.468 14.5999 9.8513 15.3249C9.0263 16.3249 7.71797 16.9665 6.2513 16.9665L4.0763 18.2582C3.70964 18.4832 3.24297 18.1749 3.29297 17.7499L3.5013 16.1082C2.38464 15.3332 1.66797 14.0915 1.66797 12.6915C1.66797 11.2249 2.4513 9.9332 3.6513 9.16654C4.39297 8.6832 5.28464 8.4082 6.2513 8.4082C8.78463 8.4082 10.8346 10.3249 10.8346 12.6915Z"
                                        fill="#E8EDFF"
                                    />
                                </svg>
                                Chat with support
                            </button>
                    </div>
                </div>
        </div>
    </MainLayout>
</template>

<style scoped></style>
