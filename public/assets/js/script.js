let hasCounted = false;

        // Fungsi untuk mengecek apakah elemen terlihat di viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Fungsi untuk menjalankan count-up
        function countUp() {
            const client = document.getElementById('count_client');
            const kualitas = document.getElementById('count_kualitas');
            const project = document.getElementById('count_project');

            // Definisikan angka akhir
            const clientEnd = 300; // misalnya, 300 client
            const kualitasEnd = 100; // misalnya, 90%
            const projectEnd = 50; // misalnya, 50 project

            // Durasi total 3 detik (3000 ms)
            const duration = 3000;
            const steps = 100; // Jumlah langkah untuk mencapai angka akhir dalam 3 detik
            const stepDuration = duration / steps; // Waktu per langkah

            // Hitung increment untuk setiap langkah
            const clientIncrement = clientEnd / steps;
            const kualitasIncrement = kualitasEnd / steps;
            const projectIncrement = projectEnd / steps;

            let clientCount = 0;
            let kualitasCount = 0;
            let projectCount = 0;

            const clientInterval = setInterval(() => {
                if (clientCount < clientEnd) {
                    clientCount += clientIncrement;
                    client.innerText = Math.floor(clientCount); // Pembulatan agar angka terlihat lebih rapi
                } else {
                    clearInterval(clientInterval);
                }
            }, stepDuration);

            const kualitasInterval = setInterval(() => {
                if (kualitasCount < kualitasEnd) {
                    kualitasCount += kualitasIncrement;
                    kualitas.innerText = Math.floor(kualitasCount); // Pembulatan
                } else {
                    clearInterval(kualitasInterval);
                }
            }, stepDuration);

            const projectInterval = setInterval(() => {
                if (projectCount < projectEnd) {
                    projectCount += projectIncrement;
                    project.innerText = Math.floor(projectCount); // Pembulatan
                } else {
                    clearInterval(projectInterval);
                }
            }, stepDuration);
        }

        // Event listener untuk mendeteksi scroll
        window.addEventListener('scroll', function() {
            const countContainer = document.getElementById('count-container');

            if (isElementInViewport(countContainer) && !hasCounted) {
                hasCounted = true;
                countUp();
            }
        });