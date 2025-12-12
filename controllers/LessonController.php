<?php
class LessonController {
    private $lessonModel;
    private $materialModel;

    public function __construct() {
        if (!AuthHelper::isInstructor()) {
            header("Location: /login");
            exit();
        }

        $this->lessonModel = new Lesson();
        $this->materialModel = new Material();
    }

    /** Danh sách bài học */
    public function index() {
        $course_id = $_GET['course_id'];
        $lessons = $this->lessonModel->getByCourseId($course_id);

        include "views/instructor/lessons/manage.php";
    }

    /** Hiển thị form tạo bài học */
    public function create() {
        $course_id = $_GET['course_id'];
        include "views/instructor/lessons/create.php";
    }

    /** Lưu bài học mới */
    public function store() {
        $data = [
            'course_id' => $_POST['course_id'],
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'video_url' => $_POST['video_url'],
            'order' => $_POST['order']
        ];

        $this->lessonModel->create($data);

        header("Location: index.php?controller=lesson&action=index&course_id=".$_POST['course_id']);
        exit();
    }

    /** Hiển thị form sửa */
    public function edit() {
        $id = $_GET['id'];
        $lesson = $this->lessonModel->find($id);

        include "views/instructor/lessons/edit.php";
    }

    /** Cập nhật bài học */
    public function update() {
        $id = $_POST['id'];
        $course_id = $_POST['course_id'];

        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'video_url' => $_POST['video_url'],
            'order' => $_POST['order']
        ];

        $this->lessonModel->update($id, $data);

        header("Location: index.php?controller=lesson&action=index&course_id=$course_id");
        exit();
    }

    /** Xóa bài học */
    public function delete() {
        $id = $_GET['id'];
        $course_id = $_GET['course_id'];

        $this->lessonModel->delete($id);

        header("Location: index.php?controller=lesson&action=index&course_id=$course_id");
        exit();
    }
}
?>
