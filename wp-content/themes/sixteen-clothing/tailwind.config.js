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
}