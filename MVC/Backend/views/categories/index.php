<!--//views/categories/index.php-->
<!--
-Thong thuong chuc nang tim kiem trong backend se nam chung voi trang liet ke
-Form tim kiem thi se o phuong thuc get
-->
<h2>Tìm kiếm danh mục</h2>
<form action="" method="get">
<!--
Neu form sd phuong thuc GET,can phai them 2 input co thuoc tinh name tuong ung la controller & action,
vi phuong thuc GET se do du lieu cua thuoc tinh name cua input trong form len URL,dan den mat 2 tham so controller & action mac dinh cua url
-->
    <input type="hidden" name="controller" value="category">
    <input type="hidden" name="action" value="index">

    <div class="form-group">
<!--The label dung de ket hop voi input de tao ra hieu ung click label->tro chuot input-->
        <label for="name">Nhập name</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>" class="form-control">
    </div>

    <div class="form-group">
        <?php
        $selected_disabled = '';
        $selected_active = '';
        if( isset($_GET['status'])){
            switch ($_GET['status']){
                case 0: $selected_disabled = 'selected';
                break;
                case 1: $selected_active = 'selected';
                break;
            }
        }
        ?>
        <label for="status">Chọn trạng thái</label>
        <select name="status" id="status" class="form-control">
            <option value="0" <?php echo $selected_disabled ?> >Disabled</option>
            <option value="1" <?php echo $selected_active ?> >Active</option>
        </select>
    </div>

    <div class="form-group">
        <input  type="submit" name="submit" value="Search" class="btn btn-success">
        <a class="btn btn-default" href="index.php?controller=category&action=index">Xoá filter</a>
    </div>
</form>

<h1>Danh sách category</h1>
<a href="index.php?controller=category&action=create" class="btn btn-primary">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td>
                    <?php echo $category['id']; ?>
                </td>
                <td>
                    <?php echo $category['name']; ?>
                </td>
                <td>
                    <?php if (!empty($category['avatar'])): ?>
                        <img src="assets/uploads/<?php echo $category['avatar'] ?>" width="60"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $category['description']; ?>
                </td>
                <td>
                    <?php
                    $status_text = 'Active';
                    if ($category['status'] == 0) {
                        $status_text = 'Disabled';
                    }
                    echo $status_text;
                    ?>
                </td>
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($category['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($category['updated_at']));
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=category&action=detail&id=<?php echo $category['id'] ?>"
                       title="Chi tiết">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="index.php?controller=category&action=update&id=<?php echo $category['id'] ?>" title="Sửa">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>

                    <a href="index.php?controller=category&action=delete&id=<?php echo $category['id'] ?>" title="Xóa"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Không có bản ghi nào</td>
        </tr>
    <?php endif; ?>
</table>
<!--  hiển thị phân trang-->
<?php echo $pagination; ?>

