<?=getVar('data')?>
<form method="GET" action="/" class="d-flex flex-column guitar-filter" style="min-width:250px;" data-bs-theme="dark">
    <!-- Скрытый параметр do -->
     <input type="hidden" name="do" value="guitars" />

    <label for="catid" class="mb-2 fs-4">Категория:</label>
    <select name="catid" id="catid" class="form-select p-2 mb-3 ">
        <option value="">Все</option>
        <?= renderCategory(isset($_GET['catid']) ? $_GET['catid'] : false); ?>
    </select>

    <label for="brand" class="mb-2 fs-4">Бренд:</label>
    <select name="brand" id="brand" class="form-select mb-3">
        <option value="">Все</option>
        <?php
        for ($i = 1; $i <= 6; $i++) {
            $selected = isset($_GET['brand']) && $_GET['brand'] == $i ? 'selected' : '';
            echo "<option value='{$i}' {$selected}>" . getBrand($i) . "</option>";
        }
        ?>
    </select>

    <label for="price" class="mb-2 fs-4">Цена:</label>
    <select name="price" id="price" class="form-select p-2 mb-3">
        <option value="">Нет сортировки</option>
        <option value="low_high" <?= isset($_GET['price']) && $_GET['price'] == 'low_high' ? 'selected' : ''; ?>>От низкой к высокой</option>
        <option value="high_low" <?= isset($_GET['price']) && $_GET['price'] == 'high_low' ? 'selected' : ''; ?>>От высокой к низкой</option>
    </select>

    <label for="strings" class="mb-2 fs-4">Количество струн:</label>
    <select name="strings" id="strings" class="form-select p-2 mb-3">
        <option value="">Все</option>
        <option value="6" <?= isset($_GET['strings']) && $_GET['strings'] == 6 ? 'selected' : ''; ?>>6 струн</option>
        <option value="7" <?= isset($_GET['strings']) && $_GET['strings'] == 7 ? 'selected' : ''; ?>>7 струн</option>
    </select>

    <label for="pickups" class="mb-2 fs-4">Звукосниматели:</label>
    <select name="pickups" id="pickups" class="form-select p-2 mb-4">
        <option value="">Все</option>
        <option value="H-H" <?= isset($_GET['pickups']) && $_GET['pickups'] == 'Humbucker' ? 'selected' : ''; ?>>H-H</option>
        <option value="" <?= isset($_GET['pickups']) && $_GET['pickups'] == 'Single Coil' ? 'selected' : ''; ?>>H-S-H</option>
    </select>

    <button type="submit" class="btn buttons mb-5 p-3">Применить фильтры</button>
</form>   