import apiClient from "../api/axios";

export const existPromo = async (promo) => {
    const response = await apiClient.get(`/system/check-promo?promo=${promo}`);
    return response.data?.exist || false;
};
