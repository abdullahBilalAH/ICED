<!DOCTYPE html>
<html>
<head>
    <title>Input Main Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Input Main Info</h1>
    <form action="{{ route('saveMainInfo') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <h2>Hero Page</h2>
            <div class="form-group">
                <label for="hero_img">Image:</label>
                <input type="file" class="form-control-file" name="hero_page[img]" id="hero_img">
                @if(isset($data['hero_page']['img']) && $data['hero_page']['img'])
                    <img src="{{ Storage::url($data['hero_page']['img']) }}" alt="Hero Image" class="img-thumbnail mt-2" width="150">
                @endif
            </div>
            <div class="form-group">
                <label for="hero_category">Category:</label>
                <select class="form-control" name="hero_page[category]" id="hero_category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($data['hero_page']['category']) && $data['hero_page']['category'] == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="hero_txt">Text:</label>
                <input type="text" class="form-control" name="hero_page[txt]" id="hero_txt" value="{{ $data['hero_page']['txt'] ?? '' }}">
            </div>
        </div>

        <div class="mb-4">
            <h2>Categories Scroll</h2>
            <div id="categories_scroll_container">
                @forelse($data['categories_scroll'] ?? [''] as $index => $category)
                    <div class="form-group">
                        <label for="category_{{ $index + 1 }}">Category {{ $index + 1 }}:</label>
                        <select class="form-control" name="categories_scroll[]" id="category_{{ $index + 1 }}">
                            @foreach($categories as $categoryItem)
                                <option value="{{ $categoryItem->id }}" {{ $category == $categoryItem->id ? 'selected' : '' }}>
                                    {{ $categoryItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @empty
                    <div class="form-group">
                        <label for="category_1">Category 1:</label>
                        <select class="form-control" name="categories_scroll[]" id="category_1">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforelse
            </div>
            <button type="button" class="btn btn-secondary" onclick="addCategory()">Add Another Category</button>
        </div>

        <div class="mb-4">
            <h2>Featured Section (Max 5)</h2>
            <div id="featured_section_container">
                @for ($i = 0; $i < 5; $i++)
                    <div class="form-group">
                        <label for="featured_{{ $i + 1 }}">Featured {{ $i + 1 }}:</label>
                        <select class="form-control" name="featured_section[]" id="featured_{{ $i + 1 }}">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($data['Featured Section'][$i]) && $data['Featured Section'][$i] == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endfor
            </div>
        </div>

        <div class="mb-4">
            <h2>Banner 1</h2>
            <div class="form-group">
                <label for="banner1_img">Image:</label>
                <input type="file" class="form-control-file" name="banner1[img]" id="banner1_img">
                @if(isset($data['banner1']['img']) && $data['banner1']['img'])
                    <img src="{{ Storage::url($data['banner1']['img']) }}" alt="Banner 1 Image" class="img-thumbnail mt-2" width="150">
                @endif
            </div>
            <div class="form-group">
                <label for="banner1_category">Category:</label>
                <select class="form-control" name="banner1[category]" id="banner1_category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($data['banner1']['category']) && $data['banner1']['category'] == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4">
            <h2>Banner 2</h2>
            <div class="form-group">
                <label for="banner2_img">Image:</label>
                <input type="file" class="form-control-file" name="banner2[img]" id="banner2_img">
                @if(isset($data['banner2']['img']) && $data['banner2']['img'])
                    <img src="{{ Storage::url($data['banner2']['img']) }}" alt="Banner 2 Image" class="img-thumbnail mt-2" width="150">
                @endif
            </div>
            <div class="form-group">
                <label for="banner2_category">Category:</label>
                <select class="form-control" name="banner2[category]" id="banner2_category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($data['banner2']['category']) && $data['banner2']['category'] == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function addCategory() {
        const container = document.getElementById('categories_scroll_container');
        const index = container.children.length + 1;
        const div = document.createElement('div');
        div.className = 'form-group';
        div.innerHTML = `
            <label for="category_${index}">Category ${index}:</label>
            <select class="form-control" name="categories_scroll[]" id="category_${index}">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        `;
        container.appendChild(div);
    }
</script>
</body>
</html>
