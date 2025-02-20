document.addEventListener("DOMContentLoaded", function () {
    const imageContainer = document.getElementById("image-preview-container");
    const fileInput = document.getElementById("images");
    const noImagesMessage = document.getElementById("no-images-message");

    if (!imageContainer || !fileInput) {
        return;
    }

    let fileList = [];

    fileInput.addEventListener("change", function () {
        if (noImagesMessage) {
            noImagesMessage.style.display = "none";
        }

        const newFiles = Array.from(fileInput.files);
        newFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement("div");
                div.classList.add("admin-products-add-image-box");
                div.dataset.index = fileList.length;
                div.innerHTML = `
                    <img src="${e.target.result}" alt="プレビュー画像" class="admin-products-add-image">
                    <button type="button" class="admin-products-add-delete-image-button" data-index="${fileList.length}">削除</button>
                `;
                imageContainer.appendChild(div);
                fileList.push(file);
                updateFileInput();
            };
            reader.readAsDataURL(file);
        });

        setTimeout(initializeSortable, 500);
    });

    imageContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("admin-products-add-delete-image-button")) {
            if (!confirm("本当にこの画像を削除しますか？")) {
                return;
            }

            const index = parseInt(e.target.dataset.index, 10);
            fileList.splice(index, 1);
            e.target.closest(".admin-products-add-image-box").remove();
            updateFileInput();

            if (fileList.length === 0 && noImagesMessage) {
                noImagesMessage.style.display = "block";
            }
        }
    });

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        fileList.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    document.getElementById('images').addEventListener('change', function (event) {
        let files = Array.from(event.target.files);
        let validExtensions = ["jpeg", "png", "jpg", "gif", "webp"];
        let errorMessage = "";

        files.forEach(file => {
            let fileExt = file.name.split('.').pop().toLowerCase();
            if (!validExtensions.includes(fileExt)) {
                errorMessage += file.name + " は無効な形式です。\n";
            }
            if (file.size > 5 * 1024 * 1024) {
                errorMessage += file.name + " はサイズオーバーです（最大 5MB）。\n";
            }
        });

        if (errorMessage) {
            alert(errorMessage);
            event.target.value = "";
        }
    });

    function initializeSortable() {
        new Sortable(imageContainer, {
            animation: 150,
            ghostClass: "sortable-ghost",
            onEnd: function () {
                updateFileListOrder();
            }
        });
    }

    function updateFileListOrder() {
        let newFileList = [];
        document.querySelectorAll(".admin-products-add-image-box").forEach((box, index) => {
            const oldIndex = parseInt(box.dataset.index, 10);
            newFileList[index] = fileList[oldIndex];
            box.dataset.index = index;
            box.querySelector(".admin-products-add-delete-image-button").dataset.index = index;
        });
        fileList = newFileList;
        updateFileInput();
    }

    initializeSortable();
});