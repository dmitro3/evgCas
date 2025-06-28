watch(() => userStore.user?.balance, (newBalance, oldBalance) => {
    if (oldBalance !== undefined && newBalance !== oldBalance && oldBalance !== null) {
        isBalanceChanged.value = true;
        setTimeout(() => {
            isBalanceChanged.value = false;
        }, 1000);
    }
});
