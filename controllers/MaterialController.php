<?php
class MaterialController {
    private $materialModel;

    public function __construct() {
        if (!AuthHelper::isInstructor()) {
            header("Location: /login");
            exit();
        }

        $this->materialModel = new Material();
    }

    /** Hiển thị danh sách tài liệu */
    public function index() {
        $lesson_id = $_GET['lesson_id'];
        $materials = $this->materialModel->getByLessonId($lesson_id);

        include "views/instructor/materials/manage.php";
    }

    /** Upload tài liệu */
    public function store() {
        $lesson_id = $_POST['lesson_id'];
        $file = $_FILES['file'];

        $target_dir = "assets/materials/";
        $file_name = uniqid() . "_" . basename($file['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $data = [
                'lesson_id' => $lesson_id,
                'filename' => $file['name'],
                'file_path' => $file_name,
                'file_type' => $file['type']
            ];

            $this->materialModel->create($data);

            header("Location: index.php?controller=material&action=index&lesson_id=$lesson_id");
            exit();
        }
    }

    /** Xóa tài liệu */
    public function delete() {
        $id = $_GET['id'];
        $lesson_id = $_GET['lesson_id'];

        $this->materialModel->delete($id);

        header("Location: index.php?controller=material&action=index&lesson_id=$lesson_id");
        exit();
    }
}
?>
