export default {
    methods: {
        limparModal() {
            this.butonSave = true;
            this.name = "";
            this.birthdate = "";
            this.cpf = "";
        },
        modalHide: function () {
            $('#modal').modal('hide');
            $(".close").trigger("click");
            $(".fade").removeClass("modal-backdrop");
        },
        toggleClassButton: function (prefix, id, removeclass, addclass) {
            $(`#${prefix}${id} i`).removeClass(removeclass).addClass(addclass);
        },
        toggleModal: function () {
            let local = this;
            $(".close").on("click", function () {
                local.limparModal();
                local.butonSave = true;
            });
        },
        uploadImage: function (e) {
            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = (e) => {
                this.previewImage = e.target.result;
            };

            let formData = new FormData();
            formData.append("image", image);
            this.sendData = formData;
        },
        convertDateTime(dateTime) {
            let options = {
                year: "numeric",
                month: "numeric",
                day: "numeric",
                hour: "numeric",
                minute: "numeric",
                second: "numeric",
                hour12: false,
                timeZone: "America/Sao_Paulo",
            };

            dateTime = dateTime
                .replace(" ", "-")
                .replace(":", "-")
                .replace(":", "-")
                .replace("T", "-")
                .replace(".", "-");
            var arr = dateTime.split("-");
            dateTime = new Intl.DateTimeFormat("default", options).format(
                new Date(arr[0], arr[1] - 1, arr[2], arr[3], arr[4], arr[5])
            );
            return dateTime;
        },
        //carregar scripts externos
        loadJs(url, callback) {
            jQuery.ajax({
                url: url,
                dataType: "script",
                success: callback,
                async: true,
            });
        },
    }
}