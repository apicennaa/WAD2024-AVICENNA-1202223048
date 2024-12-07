<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di EAD Universitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            overflow: hidden;
        }

        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            perspective: 1000px;
        }

        .card-container {
            width: 90%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            transform-style: preserve-3d;
            transition: all 0.5s ease;
        }

        .card-container:hover {
            transform: rotateY(10deg);
        }

        .uad-title {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .uad-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-dosen {
            background: linear-gradient(to right, #ff6b6b, #ff4757);
            color: white;
        }

        .btn-mahasiswa {
            background: linear-gradient(to right, #1abc9c, #16a085);
            color: white;
        }

        .btn-action i {
            margin-right: 15px;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.5s ease;
        }

        .btn-action:hover::before {
            left: 0;
        }

        .btn-action:hover {
            transform: translateY(-5px);
        }

        .btn-action:hover i {
            transform: rotate(360deg);
        }

        .background-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes particleAnimation {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-100vh) rotate(360deg); }
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particleAnimation linear infinite;
        }
    </style>
</head>
<body>
    <div class="background-particles" id="particlesContainer"></div>

    <div class="welcome-container">
        <div class="card-container">
            <div class="uad-title">
                <h1>WELCOME!</h1>
                <p class="text-center text-white">EAD UNIVERSITY</p>
            </div>

            <div class="action-buttons">
                <a href="{{ route('dosen.create') }}" class="btn btn-action btn-dosen">
                    <i class="ri-user-teacher-line"></i>Tambah Dosen
                </a>
                
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-action btn-mahasiswa">
                    <i class="ri-graduation-cap-line"></i>Tambah Mahasiswa
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function createParticles() {
            const container = document.getElementById('particlesContainer');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                particle.style.width = `${Math.random() * 10}px`;
                particle.style.height = particle.style.width;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                particle.style.opacity = Math.random();

                container.appendChild(particle);
            }
        }

        createParticles();
    </script>
</body>
</html>