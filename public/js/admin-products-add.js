document.addEventListener("DOMContentLoaded", function () {
    const imageContainer = document.getElementById("image-preview-container");
    const fileInput = document.getElementById("images");
    const noImagesMessage = document.getElementById("no-images-message");

    if (!imageContainer) {
        return;
    }

    fileInput.addEventListener("change", function () {
        if (noImagesMessage) {
            noImagesMessage.style.display = "none";
        }
        Array.from(fileInput.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement("div");
                div.classList.add("admin-products-add-image-box");
                div.dataset.index = imageContainer.children.length;
                div.innerHTML = `
                    <img src="${e.target.result}" alt="プレビュー画像" class="admin-products-add-image">
                    <button type="button" class="admin-products-add-delete-image-button">削除</button>
                `;
                imageContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });
    imageContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("admin-products-add-delete-image-button")) {
            if (!confirm("本当にこの画像を削除しますか？")) {
                return;
            }
            e.target.closest(".admin-products-add-image-box").remove();
            if (imageContainer.querySelectorAll(".admin-products-add-image-box").length === 0) {
                noImagesMessage.style.display = "block";
            }
        }
    });
});

document.getElementById('images').addEventListener('change', function (event) {
    let files = event.target.files;
    let validExtensions = ["jpeg", "png", "jpg", "gif", "webp"];
    let errorMessage = "";

    for (let i = 0; i < files.length; i++) {
        let fileExt = files[i].name.split('.').pop().toLowerCase();
        if (!validExtensions.includes(fileExt)) {
            errorMessage += files[i].name + " は無効な形式です。\n";
        }
        if (files[i].size > 5 * 1024 * 1024) {
            errorMessage += files[i].name + " はサイズオーバーです（最大 5MB）。\n";
        }
    }

    if (errorMessage) {
        alert(errorMessage);
        event.target.value = "";
    }
});
