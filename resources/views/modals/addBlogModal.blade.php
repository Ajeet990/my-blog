<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Blog
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Blog</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="addNewBlog" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="blogName" class="form-label">Blog Name</label>
                  <input type="text" name="blogName" class="form-control" id="blogName">
                    <span style="color:red">@error('blogName') {{$message}} @enderror</span>

                </div>
                <div class="mb-3">
                  <label for="blogDescr" class="form-label">Blog Description</label>
                  <input type="text" name="blogDescr" class="form-control" id="blogDescr">
                    <span style="color:red">@error('blogDescr') {{$message}} @enderror</span>

                </div>
                <div class="mb-3 border">
                  @if (count($categories) > 0)
                    <label for="blogName" class="form-label">Please choose categories</label>
                      @foreach ($categories as $category)
                        <div class="form-check ml-1">
                          <input class="form-check-input" name="checkCategory[]" type="checkbox" value="{{ $category['id'] }}" >
                          <label class="form-check-label" for="flexCheckDefault">
                            {{ $category['title'] }}
                          </label>
                        </div>
                      @endforeach
                    @else
                    <span>No categories added till now.</span>
                  @endif
                  <span style="color:red">@error('checkCategory') {{$message}} @enderror</span>

                </div>
                <div class="mb-3">
                  <label for="blogImage" class="form-label">Blog Image</label>
                  <input type="file" name="blogImage" class="form-control" id="blogImage">
                    <span style="color:red">@error('blogImage') {{$message}} @enderror</span>

                </div>
                <button type="submit" class="btn btn-primary">Add Blog</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>