

<style>
    @media (max-width: 767px) {
        .sakib {
            display: flex;
            flex-direction: column;
        }
    }
    .slider-container1 {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 2000px;
        border: none;
    }

    .slider-wrapper1 {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slider-item1 {
        flex: 0 0 100%;
    }

    .slider-item1 img {
        width: 100%;
        height: 410px;
    }

    .slider-pagination1 {
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        width: auto;
        max-width: calc(100% - 20px);
        margin: 0;
    }

    .bullet1 {
        width: 14px;
        height: 14px;
        background-color: rgb(188, 188, 188);
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
    }

    .bullet1.active1 {
        background-color: rgb(21 86 231);
    }
    @media (max-width: 767px) {
        .slider-item1 img {
            height: 180px;
        }
    }


    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .btn-block {
        border-radius: 4px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

   



</style>



<!-- slideshow start -->
<div class="slider-container1">
    <div class="slider-wrapper1">

        @foreach ($consernsliders as $slider)
        <div class="slider-item1">
            <img src="{{asset('public'.$slider->img)}}" alt="{{$slider->alt}}">
        </div>
        @endforeach
    </div>
    <div class="slider-pagination1"></div>
</div>
<!-- slideshow end -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentIndex = 0;
        var slides = document.querySelectorAll('.slider-item1');
        var totalSlides = slides.length;

        // Create bullets and add them to the pagination container
        var paginationContainer = document.querySelector('.slider-pagination1');
        for (var i = 0; i < totalSlides; i++) {
            var bullet = document.createElement('div');
            bullet.classList.add('bullet1');
            bullet.setAttribute('data-index', i);
            paginationContainer.appendChild(bullet);
        }

        // Highlight the active bullet
        function updatePagination() {
            var bullets = document.querySelectorAll('.bullet1');
            bullets.forEach(function(bullet) {
                bullet.classList.remove('active1');
            });
            bullets[currentIndex].classList.add('active1');
        }

        // Set up event listeners for bullets
        var bullets = document.querySelectorAll('.bullet1');
        bullets.forEach(function(bullet) {
            bullet.addEventListener('click', function() {
                currentIndex = parseInt(this.getAttribute('data-index'));
                updateSlider();
            });
        });

        // Update the slider based on the current index
        function updateSlider() {
            var newTransformValue = -currentIndex * 100 + '%';
            document.querySelector('.slider-wrapper1').style.transform = 'translateX(' + newTransformValue + ')';
            updatePagination();
        }

        // Automatic sliding
        function autoSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        }

        // Set up automatic sliding interval
        var intervalId = setInterval(autoSlide, 3000); // Adjust the interval time as needed

        // Pause automatic sliding on mouseover
        document.querySelector('.slider-container1').addEventListener('mouseover', function() {
            clearInterval(intervalId);
        });

        // Resume automatic sliding on mouseout
        document.querySelector('.slider-container1').addEventListener('mouseout', function() {
            intervalId = setInterval(autoSlide, 3000);
        });

        // Initial setup
        updateSlider();
    });
</script>