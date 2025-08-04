<!------------ Main Content Start ----------->
<main>
    <!-- Blog Content -->
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <!-- Main Blog Content -->
                <div class="col-lg-8">
                    <div class="row">

                        @foreach ($posts as $item)
                            <div class="col-md-6 mb-4 animate__animated animate__fadeInUp" data-wow-delay="0.1s">
                                <div class="blog-card h-100">
                                    {{-- <img src="{{ asset($item->image) }}" class="blog-card-img w-100" alt="Blog Image"> --}}
                                    <img src="{{ asset('frontend/assets/images/w11.jpg') }}" class="blog-card-img w-100"
                                        alt="Blog Image">
                                    <div class="blog-card-body">
                                        <span
                                            class="blog-category">{{ $item->category->category_name ?? 'Uncategorized' }}</span>
                                        <h3 class="blog-card-title">
                                            <a href="{{ route('blog.detail', ['post_slug' => $item->post_slug]) }}">
                                                {{ $item->post_title }}
                                            </a>
                                        </h3>
                                        <p class="blog-card-text">
                                            {!! Str::limit(strip_tags($item->post_content), 100) !!}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="blog-meta">
                                                <span><i
                                                        class="far fa-calendar-alt"></i>{{ $item->created_at ? $item->created_at->format('F d, Y') : 'No Date' }}</span>

                                                <span><i class="far fa-eye"></i> 2.1K</span> {{-- replace with real views if available --}}
                                            </div>
                                            <a href="{{ route('blog.detail', ['post_slug' => $item->post_slug]) }}"
                                                class="read-more">
                                                Read More <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>


                    {{--                    <!-- Pagination --> --}}
                    {{--                    <nav aria-label="Blog pagination" class="mt-5 animate__animated animate__fadeIn"> --}}
                    {{--                        <ul class="pagination justify-content-center"> --}}
                    {{--                            <li class="page-item disabled"> --}}
                    {{--                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a> --}}
                    {{--                            </li> --}}
                    {{--                            <li class="page-item active"><a class="page-link" href="#">1</a></li> --}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">2</a></li> --}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
                    {{--                            <li class="page-item"> --}}
                    {{--                                <a class="page-link" href="#">Next</a> --}}
                    {{--                            </li> --}}
                    {{--                        </ul> --}}
                    {{--                    </nav> --}}
                </div>

                <!-- Blog Sidebar -->
                <div class="col-lg-4 animate__animated animate__fadeIn">
                    <!-- Search Widget -->
                    <!-- <div class="blog-sidebar mb-4">
                        <h4 class="sidebar-title">Search</h4>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="Search articles...">
                        </div>
                    </div> -->

                    <!-- Categories Widget -->
                    <div class="blog-sidebar mb-4">
                        <h4 class="sidebar-title">Categories</h4>
                        <ul class="categories-list">

                            @foreach ($categories as $category)
                                <li>
                                    <a href="#">
                                        {{ $category->category_name }}
                                        <span>{{ $category->posts_count ?? 0 }}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <!-- Popular Posts Widget -->
                    <div class="blog-sidebar mb-4">
                        <h4 class="sidebar-title">Popular Posts</h4>
                        <ul class="popular-posts">

                            @foreach ($posts as $blog)
                                <li>
                                    <div class="popular-post">
                                        <img src="{{ asset($blog->image) }}" class="popular-post-img"
                                            alt="Popular Post">
                                        <div>
                                            <h5 class="popular-post-title"><a href="#">{{ $blog->post_title }}</a>
                                            </h5>
                                            <p class="popular-post-date">
                                                {{ $item->created_at ? $item->created_at->format('F d, Y') : 'No Date' }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </section>
</main>
<!-- ======= MAIN CONTENT END ======= -->
