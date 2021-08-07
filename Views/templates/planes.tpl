<!DOCTYPE html>
<html>
<head>
    <title>Planes</title>
    <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://github.com/cowboy/jquery-message-queuing/raw/master/jquery.ba-jqmq.min.js"></script>
    <script src="/scripts/js/planes.js"></script>
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
            <tr class="data" data-id=<?php $plane['id'] ?>>
                <td class="name"><?= $plane['name'] ?></td>
                <td class="status"><?= $plane['status'] ?></td>
                <td class="button"><button type="submit">На взлет</button></td>
            </tr>
            <?php endforeach; ?>
        </ul>
    </div>
    <script>
        $(planes.init);
    </script>
</body>
</html>