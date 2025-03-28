<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/css/bootstrap.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    <title>Register</title>
  </head>
  <body>
    <div id="wrapper">
      <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-0">
          <div id="header-logo" class="seller-center-logo">
            <div
              class="d-flex justify-content-center align-items-center h-100 w-100"
            >
              <h5 class="m-0 fw-bold text-primary">Hiring-Exam</h5>
            </div>
          </div>
        </div>
      </header>
      <div id="content" class="login-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <div class="col-lg-5 col-sm-10 col-12 col-md-8 mt-5">
                <div id="login-container">
                  <h2 class="mb-4">Register</h2>
                  @if(session('error'))
                  <div class="alert alert-danger mb-0">{{ session('error') }}</div>
                  @endif
                  @error('name')
                  <div class="alert alert-danger mb-1">{{ $message }}</div>
                  @enderror
                  @error('email')
                  <div class="alert alert-danger mb-1">{{ $message }}</div>
                  @enderror
                  @error('password')
                  <div class="alert alert-danger mb-3">{{ $message }}</div>
                  @enderror
                  <form action="{{ route('register.process') }}" method="post" id="main-form">
                    @csrf
                    <div class="input-group mb-3 mt-2">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Name"
                        name="name"
                      />
                    </div>
                    <div class="input-group mb-3 mt-2">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Email"
                        name="email"
                      />
                    </div>
                    <div class="input-group mb-3 mt-2">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-lock"></i
                      ></span>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Password"
                        name="password"
                      />
                    </div>
                    <div class="input-group mb-3 mt-2">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-lock"></i
                      ></span>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Password Confirmation"
                        name="password_confirmation"
                      />
                    </div>
                    <div class="d-flex justify-content-center mt-3 w-100">
                        <button class="btn btn-primary w-100" type="submit" id="submitButton">
                            <span id="loader" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                            Register
                        </button>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 mt-2">
                      Already have an account?
                    </a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="ms-0">
        <p>&copy; 2025 Aaron Aludo - Backend Developer Exam</p>
      </footer>
    </div>
    <script
      type="text/javascript"
      src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"
    ></script>
    <script
      type="text/javascript"
      src="{{ asset('assets/js/main-form-loader-animation.js') }}"
    ></script>
  </body>
</html>
