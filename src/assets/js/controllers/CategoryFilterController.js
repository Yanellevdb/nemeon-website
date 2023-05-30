document.addEventListener('DOMContentLoaded', function () {
  // Get the category filter buttons
  const categoryButtons = document.querySelectorAll('.category-box')

  // Attach a click event listener to each button
  categoryButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      const category = this.getAttribute('data-category')

      // Call the function to filter blog posts by category
      filterBlogPosts(category)
    })
  })

  // Function to filter blog posts by category
  function filterBlogPosts(category) {
    // Get the blog posts container
    const container = document.getElementById('blog-posts-container')

    // Show loading indicator or perform any visual feedback
    container.innerHTML = 'Loading...'

    // Make an AJAX request to fetch blog posts for the selected category
    const xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // On successful response, update the blog posts container
          container.innerHTML = xhr.responseText
        } else {
          // Handle error cases
          container.innerHTML = 'Error loading blog posts.'
        }
      }
    }
    // Adjust the URL according to your server endpoint to fetch blog posts for the category
    xhr.open('GET', `/api/blog-posts?category=${category}`, true)
    xhr.send()
  }

  // Intersection Observer for smooth scrolling
  const observerOptions = {
    rootMargin: '0px',
    threshold: 0.5, // Adjust the threshold value as per your preference
  }

  // Function to handle intersection changes
  function handleIntersection(entries, observer) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Get the category from the data attribute of the intersecting element
        const category = entry.target.getAttribute('data-category')

        // Call the function to filter blog posts by category
        filterBlogPosts(category)

        // Unobserve the current entry to prevent duplicate requests
        observer.unobserve(entry.target)
      }
    })
  }

  // Create an Intersection Observer instance
  const observer = new IntersectionObserver(handleIntersection, observerOptions)

  // Observe the category filter buttons
  categoryButtons.forEach((button) => {
    observer.observe(button)
  })
})
