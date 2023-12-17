<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget App</title>
        <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Transaction Id</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Category</th>
                <th>Account</th>
            </tr>
        </thead>
        <tbody>
            <?php if (! empty($transactions)): ?>
                <?php foreach($transactions as $tr): ?>
                    <tr>
                        <td><?php echo $tr['TransactionID'] ?></td>
                        <td><?php echo $tr['Date'] ?></td>
                        <td><?php echo $tr['Description'] ?></td>
                        <td>
                            <?php if ($tr['Amount'] < 0): ?>
                                <span style="color: red">
                                    <?php echo $tr['Amount'] ?>
                                </span>
                            <?php elseif ($tr['Amount'] > 0): ?>
                                <span style="color: green">
                                    <?php echo $tr['Amount'] ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $tr['Type'] ?></td>
                        <td><?php echo $tr['Category'] ?></td>
                        <td><?php echo $tr['Account'] ?></td>
                    </tr>
                <?php endforeach; ?>
             <?php endif; ?>
        </tbody>
    </table>
<footer>
        <table>
        <tr>
            <th>Income</th>
            <td>
                 <?php if($totalSum['income'] <0): ?>
                    <span style="color: red">
                        <?= $totalSum['income']  ?? 0 ?>
                    </span>
                <?php elseif ($totalSum['income']>0): ?>
                    <span style="color: green">
                        <?= $totalSum['income'] ?? 0 ?>
                    </span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Expenditure</th>
            <td>
                <?php if($totalSum['expenditure']<0): ?>
                    <span style="color: red">
                        <?= $totalSum['expenditure'] ?? 0 ?>
                    </span>
                <?php elseif ($totalSum['expenditure']>0): ?>
                    <span style="color: green">
                        <?= $totalSum['expenditure'] ?? 0 ?>
                    </span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Balance</th>
            <td>
                <?php if($totalSum['netTotal']<0): ?>
                    <span style="color: red">
                        <?= $totalSum['netTotal'] ?? 0 ?>
                    </span>
                <?php elseif ($totalSum['netTotal']>0): ?>
                    <span style="color: green">
                        <?= $totalSum['netTotal'] ?? 0 ?>
                    </span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</footer>
</body>
</html>