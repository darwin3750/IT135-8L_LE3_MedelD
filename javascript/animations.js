//===========================================
//INDEX ANIMATIONS
//===========================================
function indexAnimations() {
  //put every letter in the text on a separate tag
  const textWrapper = document.querySelector('.le3-animate-wavetext');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false }).add({
    targets: '.le3-animate-wavetext .letter',
    translateY: [-100, 0],
    easing: "easeOutExpo",
    delay: (el, i) => i * 30,
    duration: 800,
    offset: 600,
  }).add({
    targets: '.le3-animate-slide',
    scaleX: [0,1],
    opacity: [0,1],
    easing: "easeOutQuad",
    offset: '-=1100',
    duration: 800,
  }).add({
    targets: '.le3-animate-fadein',
    opacity: [0,1],
    easing: "easeOutExpo",
    offset: '-=200',
    duration: 600
  });
}