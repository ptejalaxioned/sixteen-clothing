/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./components/**/*.{html,js,php}", // Include PHP files in components
    "./pages/**/*.{html,js,php}", // Include PHP files in pages
    "./header.php",
    "./inc/blocks/content-banner.php",
    "./inc/blocks/content-video-catalog.php",
    "./page-video.php",
    "./single-post.php",
    "./footer.php",
  ],
    theme: {
    extend: {
      colors: {
        skyblue: '#3d9ed1',
        orangered:'#f33f3f',
        lightgray:'#f7f7f7',
      },
      width:{
      cardwidth:'32%',
      }
    },
  },
}