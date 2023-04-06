<?php
require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

$Search = getParam('search'); // yo duita line search pichadi pani search boxma k search garim bhanera herna ko lagi ho 
$SearchDate = getParam('searchDate');
function getCampaign()
{
    $Search = getParam('search');
    $SearchDate = getParam('searchDate');
    $connection = ConnectionHelper::getConnection();
    $query = "select *, (select count(*) from tbl_donor where CampaignID = tbl_Campaign.ID) as donorCount from tbl_campaign where ((:search is null) or (Name like concat('%', :search, '%')) or (Address like concat('%', :search, '%')) or (OrgName like concat('%', :search, '%'))) and ((:searchDate is null) or (Date = :searchDate))";
    $statement = $connection->prepare($query);
    $statement->bindParam('search', $Search);
    $statement->bindParam('searchDate', $SearchDate);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

$result = getCampaign();

?>

<div class="container-fluid mt-2">
    <div>
        <a href="/user/campaign/add.php" class="btn btn-danger my-2"><i class="bi bi-person-plus"></i> Add Campaign</a>
    </div>

    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title">List of Campaign</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6">
                    <form action="" method="get" class="d-flex my-2">
                        <input class="form-control me-sm-2" type="date" placeholder="Search Date" name="searchDate"
                            value="<?= $SearchDate ?>">
                        <input class="form-control me-sm-2" type="search" placeholder="Search" name="search"
                            value="<?= $Search ?>">
                        <button class="btn btn-warning my-2 my-sm-0" type="submit" style="color: red;"><i
                                class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered ">
                    <thead class="table-danger">
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Organizer Name</th>
                            <th>N0. of Donors</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php
                        $sn = 0;
                        $nd = 10;
                        foreach ($result as $campaign):
                            ?>
                            <tr>
                                <td>
                                    <?= ++$sn ?>
                                </td>
                                <td>
                                    <?= $campaign['Name'] ?>
                                </td>
                                <td>
                                    <?= $campaign['Address'] ?>
                                </td>
                                <td>
                                    <?= $campaign['OrgName'] ?>
                                </td>
                                <td>
                                    <?= $campaign['donorCount'] ?>
                                </td>
                                <td>
                                    <?= $campaign['Date'] ?>
                                </td>
                                <td class="d-flex">
                                    <a href="/user/donor/?CampaignId=<?= $campaign['ID'] ?>"
                                        class="btn btn-info  me-sm-2">Donors</a>
                                    <a class="btn btn-success  me-sm-2"
                                        href="/user/campaign/edit.php?id=<?= $campaign['ID'] ?>"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="/user/campaign/delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $campaign['ID'] ?>">
                                        <button class="btn btn-danger sm-2"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once('../../includes/footer.php');
?>