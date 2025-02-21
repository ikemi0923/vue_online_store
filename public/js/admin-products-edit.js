document.addEventListener("DOMContentLoaded", function () {
    const imageContainer = document.querySelector(".admin-products-edit-image-container");
    const fileInput = document.getElementById("images");
    const selectImageButton = document.querySelector(".admin-products-edit-add-image-button");
    const form = document.querySelector(".admin-products-edit-form");

    if (imageContainer) {
        new Sortable(imageContainer, {
            animation: 150,
            ghostClass: "sortable-ghost",
            onEnd: function () {
                saveImageOrder();
            }
        });
    }

    fileInput.addEventListener("change", function () {
        Array.from(fileInput.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement("div");
                div.classList.add("admin-products-edit-image-box");
                div.innerHTML = `
                    <img src="${e.target.result}" alt="プレビュー画像" class="admin-products-edit-image">
                    <button type="button" class="admin-products-edit-delete-image-button" data-image-id="">削除</button>
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
            const imageId = e.target.dataset.imageId || null;

            if (!confirm("本当にこの画像を削除しますか？")) {
                return;
            }

            if (imageBox) {
                imageBox.remove();
                updateNoImagesMessage();
            }

            if (imageId) {
                fetch(`/admin/products/image/${imageId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {

                        }
                    })
                    .catch(error => {

                    });
            }
        }
    });


    function updateNoImagesMessage() {
        const noImagesMessage = document.getElementById("no-images-message");
        const imageBoxes = document.querySelectorAll(".admin-products-edit-image-box");

        if (imageBoxes.length === 0 && noImagesMessage) {
            noImagesMessage.style.display = "block";
        } else if (noImagesMessage) {
            noImagesMessage.style.display = "none";
        }
    }

    function saveImageOrder() {
        const imageOrder = [];
        document.querySelectorAll(".admin-products-edit-image-box").forEach((box, index) => {
            const imageId = box.dataset.imageId;
            if (imageId) {
                imageOrder.push({
                    id: parseInt(imageId, 10),
                    order: index + 1
                });
            }
        });

        if (imageOrder.length === 0) {

        }

        fetch("/admin/products/update-image-order", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    images: imageOrder
                })
            })
            .then(response => response.json())
            .catch(error => {
            });
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        if (fileInput.files.length > 0) {
            for (let file of fileInput.files) {
                formData.append("images[]", file);
            }
        }

        fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("更新が成功しました！");
                    window.location.href = "/admin/products";
                } else {
                    alert("更新に失敗しました。");
                }
            })
            .catch(error => {
                alert("サーバーとの通信に失敗しました。");
            });

    });
});