const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


const videos = [
    "https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4",
    "https://interactive-examples.mdn.mozilla.net/media/cc0-videos/friday.mp4",
    "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4",
];

let currentIndex = 1;
const videoElements = document.querySelectorAll('video');
const overlays = document.querySelectorAll('.video-overlay');

function updateVideos() {
    videoElements[0].src = videos[(currentIndex - 1 + videos.length) % videos.length];
    videoElements[1].src = videos[currentIndex];
    videoElements[2].src = videos[(currentIndex + 1) % videos.length];
}

overlays.forEach((overlay, index) => {
    overlay.addEventListener('click', () => {
        if (index === 1) {
            const video = videoElements[1];
            if (video.paused) {
                video.play();
                overlay.innerHTML = '<span class="sr-only">Pause</span>';
            } else {
                video.pause();
                overlay.innerHTML = '<span class="icon-reproducir icon"></span>';
            }
        } else {
            currentIndex = index === 0 ? (currentIndex - 1 + videos.length) % videos.length : (currentIndex + 1) % videos.length;
            updateVideos();
            videoElements[1].pause();
            overlays[1].innerHTML = '<span class="icon-reproducir icon"></span>';
        }
    });
});