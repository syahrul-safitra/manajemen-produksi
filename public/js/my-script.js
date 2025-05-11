$(document).ready(function () {
    console.log("HOLLLLAA");

    $("#jumlah").change(function () {
        const inputTotal = $('input[name="total"]');

        const harga = $("#harga");

        var totalHarga = $(this).val() * harga.val();

        inputTotal.val(totalHarga);
    });
});
