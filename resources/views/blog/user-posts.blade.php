<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs de {{ $user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --success-color: #4ad66d;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: #f5f7ff;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        
        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            margin-top: 15px;
        }
        
        .back-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--box-shadow);
        }
        
        .blogs-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .blog-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .blog-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--secondary-color);
            padding: 20px 20px 10px;
            margin: 0;
        }
        
        .blog-meta {
            padding: 0 20px;
            color: var(--gray-color);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .blog-content {
            padding: 0 20px;
            margin-bottom: 20px;
            color: var(--dark-color);
            flex-grow: 1;
        }
        
        .blog-card a {
            display: block;
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            margin-top: auto;
        }
        
        .blog-card a:hover {
            background-color: var(--secondary-color);
        }
        
        @media (max-width: 768px) {
            .blogs-container {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
        
        /* Estilo para cuando no hay blogs */
        .blogs-container > p {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: var(--gray-color);
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blogs de {{ $user->name }}</h1>
            <a href="{{ route('usuarios.index') }}" class="back-btn">
                ← Volver a usuarios
            </a>
        </div>
        
        <div class="blogs-container">
            @forelse($blogs as $blog)
                <div class="blog-card">
                    <h2 class="blog-title">{{ $blog->title }}</h2>
                    <div class="blog-meta">
                        Publicado el {{ $blog->created_at->format('d/m/Y') }}
                    </div>
                    <div class="blog-content">
                        {{ Str::limit($blog->content, 200) }}
                    </div>
                    <a href="{{ route('posts.show', $blog->id) }}">Leer más</a>
                </div>
            @empty
                <p>Este usuario no ha publicado ningún blog aún.</p>
            @endforelse
        </div>
    </div>
</body>
</html>