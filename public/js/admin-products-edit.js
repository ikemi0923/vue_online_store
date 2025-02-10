document.addEventListener("DOMContentLoaded", function () {
    if (typeof Sortable !== "function") {
        return;
    }

    const imageContainer = document.querySelector(".admin-products-edit-image-container");
    const fileInput = document.getElementById("images");
    const selectImageButton = document.querySelector(".admin-products-edit-add-image-button");
    const noImagesMessage = document.getElementById("no-images-message");

    if (imageContainer) {
        new Sortable(imageContainer, {
            animation: 150,
            ghostClass: "sortable-ghost",
            onEnd: function () {
                saveImageOrder();
            }
        });
    }
    selectImageButton.addEventListener("click", function () {
        fileInput.click();
    });
    fileInput.addEventListener("change", function () {
        if (noImagesMessage) {
            noImagesMessage.style.display = "none";
        }
        Array.from(fileInput.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement("div");
                div.classList.add("admin-products-edit-image-box");
                div.innerHTML = `
                    <img src="${e.target.result}" alt="プレビュー画像" class="admin-products-edit-image">
                    <button type="button" class="admin-products-edit-delete-image-button">削除</button>
                `;
                imageContainer.appendChild(div);
                saveImageOrder();
            };
            reader.readAsDataURL(file);
        });
    });

    imageContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("admin-products-edit-delete-image-button")) {
            const imageBox = e.target.closest(".admin-products-edit-image-box");
            const imageId = e.target.dataset.imageId;
            if (!confirm("本当にこの画像を削除しますか？")) {
                return;
            }
            Ï
            if (imageId) {
                fetch(`/admin/products/delete-image/${imageId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            imageBox.remove();
                            saveImageOrder();
                        } else {
                            alert("画像の削除に失敗しました");
                        }
                    })
                    .catch(() => alert("エラーが発生しました"));
            } else {
                imageBox.remove();
                saveImageOrder();
            }

            if (imageContainer.children.length === 0) {
                noImagesMessage.style.display = "block";
            }
        }
    });

    function saveImageOrder() {
        const images = Array.from(imageContainer.children).map((item, index) => ({
            id: item.dataset.id || null,
            src: item.querySelector("img").src,
            order: index
        }));
        localStorage.setItem("product_images", JSON.stringify(images));
    }

    function loadSavedImages() {
        const savedImages = JSON.parse(localStorage.getItem("product_images") || "[]");
        if (savedImages.length > 0) {
            imageContainer.innerHTML = "";
            savedImages.forEach(img => {
                const div = document.createElement("div");
                div.classList.add("admin-products-edit-image-box");
                div.dataset.id = img.id;
                div.innerHTML = `
                    <img src="${img.src}" alt="商品画像" class="admin-products-edit-image">
                    <button type="button" class="admin-products-edit-delete-image-button">削除</button>
                `;
                imageContainer.appendChild(div);
            });
        }
    }

    loadSavedImages();
});
