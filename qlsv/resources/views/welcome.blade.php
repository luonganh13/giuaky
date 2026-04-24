<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên - REST API</title>
    <!-- TailwindCSS CDN để làm đẹp giao diện -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-8 text-gray-800">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md border-t-4 border-indigo-500">
        <h1 class="text-3xl font-extrabold mb-2 text-indigo-600">Hệ thống Quản lý Sinh viên</h1>
        <p class="mb-6 text-gray-600 border-b pb-4">
            Do yêu cầu bài tập tập trung ở việc thao tác Database và xây dựng REST API. 
            Vì vậy giao diện này được tạo ra để giúp bạn dễ hình dung kết quả trả về của API thay vì dùng trang chào mừng mặc định của Laravel.
        </p>
        
        <h2 class="text-xl font-bold mb-3">Các Route API đã hoàn thành (Bài 7):</h2>
        <ul class="list-disc pl-5 mb-8 text-blue-600 space-y-1">
            <li><a href="/api/students" target="_blank" class="hover:underline">GET /api/students</a></li>
            <li><code>POST /api/students</code></li>
            <li><code>GET /api/students/{id}/subjects</code></li>
            <li><code>POST /api/students/{id}/register-subject/{subject_id}</code></li>
        </ul>

        <div class="flex justify-between items-end mb-4">
            <h2 class="text-xl font-bold">Dữ liệu từ Database (Gọi API: GET /api/students)</h2>
            <button onclick="fetchStudents()" class="px-5 py-2.5 bg-indigo-500 text-white font-medium rounded-md hover:bg-indigo-600 transition shadow">
                Làm mới (Refresh)
            </button>
        </div>
        
        <div class="relative items-center mb-2">
            <div class="bg-slate-800 rounded-md p-4 max-h-96 overflow-auto shadow-inner text-green-400 font-mono text-sm leading-relaxed whitespace-pre-wrap" id="api-result">
Đang kết nối để tải dữ liệu REST API...
            </div>
        </div>
        
        <div class="mt-6 text-sm text-gray-500 italic">
            * Mẹo: CSDL của bạn (SQLite) hiện tại đang rỗng nên API sẽ trả về danh sách trống []. Hãy sử dụng Postman hoặc mã Javascript để POST data lên `/api/students` nhằm tạo dữ liệu mới (Nhớ tạo bảng Classroom trước với tham số name).
        </div>
    </div>

    <script>
        function fetchStudents() {
            const apiResultBox = document.getElementById('api-result');
            apiResultBox.innerHTML = "Đang kết nối để tải dữ liệu REST API...";
            apiResultBox.classList.remove('text-red-400');
            apiResultBox.classList.add('text-green-400');
            
            fetch('/api/students')
                .then(res => res.json())
                .then(data => {
                    if (Array.isArray(data) && data.length === 0) {
                        apiResultBox.innerHTML = "[\n  // Thành công, nhưng chưa có sinh viên nào trong DB.\n  // Bạn thử dùng API POST để thêm dữ liệu nhé!\n]";
                    } else {
                        apiResultBox.innerHTML = JSON.stringify(data, null, 2);
                    }
                })
                .catch(err => {
                    apiResultBox.classList.remove('text-green-400');
                    apiResultBox.classList.add('text-red-400');
                    apiResultBox.innerHTML = "Lỗi khi gọi API: " + err.message;
                });
        }
        
        // Gọi API khi trang web tải xong
        window.addEventListener('load', fetchStudents);
    </script>
</body>
</html>
