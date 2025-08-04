<!------------ Main Contact Start ------------>
<main>
    <!-- Contact Section Start -->
    <section class="contact-section">
        <div class="container">
            <div class="row gy-4">
                <!-- Contact Information -->
                <div class="col-lg-6">
                    <h5 class="fw-bold mb-2">Contact Information</h5>
                    <p class="text-muted mb-4">Fill the form below or write us. We will help you as soon as
                        possible.</p>

                    <div class="mb-3 p-4 rounded bg-light-pink d-flex align-items-start gap-3 shadow-sm">
                        <i class="fa-solid fa-phone fa-2x"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Phone</h6>
                            <p class="mb-0">{{ $website_setting->phone }}</p>
                        </div>
                    </div>

                    <div class="mb-3 p-4 rounded bg-light-blue d-flex align-items-start gap-3 shadow-sm">
                        <i class="fa-solid fa-envelope fa-2x"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="mb-0">{{ $website_setting->email }}</p>
                        </div>
                    </div>

                    <div class="p-4 rounded bg-light-green shadow-sm">
                        <div class="d-flex align-items-start gap-3 mb-2">
                            <i class="fa-solid fa-location-dot fa-2x"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Address</h6>
                                <p class="mb-0">{{ $website_setting->address }}</p>
                            </div>
                        </div>
                        <div>
                            <iframe
                                src="{{ $website_setting->google_map }}"
                                width="100%" height="180" class="rounded border-0"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <h4 class="fw-bold mb-3 position-relative contact-title">Get In Touch</h4>
                        <h5 class="text-center text-success">{{session('contact_message')}}</h5>
                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">First Name </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span
                                        class="text-danger">*</span> </label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="info@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject </label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Your Subject here"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" id="message" rows="4"
                                          placeholder="Type your message here" required></textarea>
                            </div>
                            <button type="submit" class="marco-btn w-100">Send Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!------------ Main Contact End ------------>
