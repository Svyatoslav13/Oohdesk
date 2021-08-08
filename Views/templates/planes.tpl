<!DOCTYPE html>
<html>
<head>
    <title>Planes</title>
    <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://github.com/cowboy/jquery-message-queuing/raw/master/jquery.ba-jqmq.min.js"></script>
    <script src="/scripts/js/planes.js"></script>
    <style>
        .hide {
            display: none;
        }
    </style>
</head>
<body>
    <div>
        <table id="schedule">
            <tr class="header">
                <th>Самолет</th>
                <th>Статус</th>
                <th></th>
            </tr>
            <?php foreach ($this->get_planes() as $plane): ?>
            <tr class="data" data-id="<?= $plane['id'] ?>">
                <td class="name"><?= $plane['name'] ?></td>
                <td class="status"><?= $plane['status'] ?></td>
                <td class="button"><button type="submit">На взлет</button></td>
                <td class="history" style="background-color: slategray;"><button data-id="<?= $plane['id'] ?>" >История</button></td>
            </tr>
            <?php foreach ($this->get_history($plane['id']) as $row): ?>
            <tr class="hide chart history" data-id="<?= $plane['id'] ?>">
                <td colspan="2"><?= $row['time'] ?></td>
                <td colspan="2"><?= $row['state'] ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <script>
        $(planes.init);
    </script>
</body>
</html>