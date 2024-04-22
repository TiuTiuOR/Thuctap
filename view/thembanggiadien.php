
<?php
if (isset($_POST['them'])) {
    echo '<button><a href="../controller/giadien.php?act=themgiadien">Hủy</a></button>';
    $so_bac = $_POST['so_bac'];
    echo '<h2>Nhập thông tin giá điện cho ' . $so_bac . ' bậc</h2>';
    echo '<form method="post" action="">';
    
    for ($i = 0; $i < $so_bac; $i++) {
        echo '<h3>Thông tin bậc ' . ($i + 1) . '</h3>';
        
        echo '<input type="hidden" name="tenbac[]" value="Bậc ' . ($i + 1) . '" required>';

        echo '<label for="tusokw">Từ số KW:</label>';
        if ($i === 0) {
            echo '<input type="number" id="tusokw_' . $i . '" name="tusokw[]" value="0" required>';
        } else {
            echo '<input type="number" id="tusokw_' . $i . '" name="tusokw[]" required>';
        }
        
        echo '<label for="densokw">Đến số KW:</label>';
        if ($i === $so_bac - 1) {
            echo '<input type="text" id="densokw_' . $i . '" name="densokw[]" value="Trở lên" readonly>';
        } else {
            echo '<input type="number" id="densokw_' . $i . '" name="densokw[]"  oninput="calculateNextTusokw(this)" required>';
        }
        
        echo '<label for="dongia">Đơn giá:</label>';
        echo '<input type="text" id="dongia_' . $i . '" name="dongia[]" required>'; 

        echo '<br><br>';
    }
    echo '<input type="submit" name="submit" value="Thêm">';
    echo '</form>';

} else {
    echo '<h2>Thêm giá điện</h2>';
    echo '<form method="post" action="" onsubmit="return kiemTraSoBac()">';
    echo '<label for="so_bac">Nhập số bậc bảng giá điện mới:</label>';
    echo '<input type="number" name="so_bac" id="so_bac" required>';
    echo '<input type="submit" name="them" value="Tiếp tục">';
    echo '</form>';
    
    echo '<br><button><a href="../controller/tiendien.php?act=quanly">Hủy</a></button>';
}
?>
<script src="../assets/js/giadienthem.js"></script>
<script>
    // Trình định nghĩa hàm kiểm tra giá trị nhập vào
    function kiemTraSoBac() {
        var soBac = document.getElementById('so_bac').value;
        var nguong = 10; // ngưỡng
        if (soBac > nguong) {
            var conformMessage = 'Bạn có chắc chắn muốn nhập ' + soBac + ' bậc?'; // Thông báo xác nhận
            if (confirm(conformMessage)) { 
                return true; 
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    // Hàm tính toán giá trị "Từ số KW" cho bậc tiếp theo
    function calculateNextTusokw(input) {
        var densokw = parseInt(input.value);
        var getI = parseInt(input.id.split('_')[1]);
        var tusokwInput = document.getElementById('tusokw_' + (getI + 1));
        var tusokw = densokw + 1;
        tusokwInput.value = tusokw;
    }

</script>
