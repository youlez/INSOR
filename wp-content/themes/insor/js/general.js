const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));



document.addEventListener('DOMContentLoaded', function() {
    const videoContainers = document.querySelectorAll('.video-container');
    const overlays = document.querySelectorAll('.video-overlay');
    let currentIndex = 1;
    let centralPlayer = null;

    // Función para extraer el ID de video de YouTube o la URL de Facebook
    function getVideoInfo(iframe) {
        const src = iframe.src;
        if (src.includes('youtube.com')) {
            const match = src.match(/embed\/([\w-]+)/);
            return match ? { type: 'youtube', id: match[1] } : null;
        } else if (src.includes('facebook.com')) {
            return { type: 'facebook', url: src };
        }
        return null;
    }

    // Obtener la información de los videos actuales
    const videos = Array.from(videoContainers).map(container => {
        const iframe = container.querySelector('iframe');
        return getVideoInfo(iframe);
    });

    function updateVideos() {
        videoContainers.forEach((container, index) => {
            const videoIndex = (currentIndex - 1 + index + videos.length) % videos.length;
            const video = videos[videoIndex];
            let iframe = container.querySelector('iframe');
            
            if (video.type === 'youtube') {
                iframe.src = `https://www.youtube.com/embed/${video.id}${index === 1 ? '?enablejsapi=1' : ''}`;
            } else if (video.type === 'facebook') {
                iframe.src = video.url;
            }

            if (index === 1) {
                iframe.id = 'central-video';
                initializeCentralVideo();
            }
        });
    }

    function initializeCentralVideo() {
        const centralVideo = document.getElementById('central-video');
        const videoInfo = getVideoInfo(centralVideo);

        if (videoInfo.type === 'youtube') {
            if (typeof YT !== 'undefined' && YT.Player) {
                centralPlayer = new YT.Player('central-video', {
                    events: {
                        'onReady': onPlayerReady
                    }
                });
            }
        } else if (videoInfo.type === 'undefined' && 'facebook') {
            if (typeof FB !== FB.XFBML) {
                FB.XFBML.parse(document.getElementById('central-video').parentNode);
                centralPlayer = null;  // Facebook doesn't provide a consistent player object
            }
        }
    }

    function onPlayerReady(event) {
        // El reproductor de YouTube está listo
    }

    function togglePlayPause() {
        const centralVideo = document.getElementById('central-video');
        const videoInfo = getVideoInfo(centralVideo);

        if (videoInfo.type === 'youtube' && centralPlayer) {
            if (centralPlayer.getPlayerState() === YT.PlayerState.PLAYING) {
                centralPlayer.pauseVideo();
                // return false;
            } else {
                centralPlayer.playVideo();
                // return true;
            }
        } else if (videoInfo.type === 'facebook') {
            // Para Facebook, simplemente recargamos el video con autoplay
            const currentSrc = centralVideo.src;
            if (currentSrc.includes('autoplay=1')) {
                centralVideo.src = currentSrc.replace('autoplay=1', 'autoplay=0');
                // return false;
            } else {
                centralVideo.src = currentSrc.includes('?') ? 
                    currentSrc + '&autoplay=1' : 
                    currentSrc + '?autoplay=1';
                // return true;
            }
        }
    }

    overlays.forEach((overlay, index) => {
        overlay.addEventListener('click', () => {
            if (index === 1) {
                // Centro: reproducir/pausar
                togglePlayPause();
            } else {
                // Izquierda o derecha: navegar
                currentIndex = index === 0 ? 
                    (currentIndex - 1 + videos.length) % videos.length : 
                    (currentIndex + 1) % videos.length;
                updateVideos();    
            }
        });
    });

    // Cargar la API de YouTube
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // Cargar el SDK de Facebook
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Inicializar los videos
    updateVideos();
});

// Función que se llama cuando la API de YouTube está lista
function onYouTubeIframeAPIReady() {
    // La API de YouTube está lista
}


