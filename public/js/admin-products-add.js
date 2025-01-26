document.addEventListener("DOMContentLoaded", function () {
    console.log("Sortableの型:", typeof Sortable);
    if (typeof Sortable !== "function") {
        console.error("Sortable.jsが正しく読み込まれていません。");
        return;
    }

    const imageContainer = document.querySelector(".admin-products-edit-image-container");

    if (imageContainer) {
        console.log("Sortable初期化中...");
        new Sortable(imageContainer, {
            animation: 150,
            ghostClass: "sortable-ghost",
            onStart: function () {
                console.log("ドラッグ開始");
            },
            onEnd: function () {
                const newOrder = Array.from(imageContainer.children).map(
                    (item) => item.dataset.id
                );
                console.log("新しい順序:", newOrder);
            },
        });
    } else {
        console.error("画像コンテナが見つかりません。");
    }
});
