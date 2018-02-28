<div>
    <table>
        <tr>
            <td>
                Результат:
            </td>
            <td class="result">
                <?= $msg ?>
            </td>
        </tr>
        <tr>
            <td>
                Количество комбинаций:
            </td>
            <td class="result">
                <?= $count ?>
            </td>
        </tr>
        <tr>
            <td>
                Файл с результатами:
            </td>
            <td class="result">
                <a href="<?= App::$params['basic_url'] ?>/home/file/<?= $filename ?>" >LINK</a>
            </td>
        </tr>
    </table>
</div>

<style type="text/css">
    table {
        border: 2px solid coral;
        padding: 20px 20px;
    }
    table .result {
        text-align: right;
        width: 200px;
    }
</style>