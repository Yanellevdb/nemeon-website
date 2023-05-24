jQuery(document).ready(function ($) {
  // Your JavaScript goes here
})

// Handle category filter clicks
$('.category-box').on('click', function (e) {
  e.preventDefault()

  // Remove active class from all category boxes
  $('.category-box').removeClass('active')

  // Add active class to the clicked category box
  $(this).addClass('active')

  // Get the selected category
  var category = $(this).data('category')

  // Send AJAX request to retrieve filtered blog posts
  $.ajax({
    url: '/wp-admin/admin-ajax.php',
    type: 'POST',
    data: {
      action: 'filter_blog_posts',
      category: category,
    },
    success: function (response) {
      // Update the blog posts container with the filtered posts
      $('.blog-posts-container').html(response)
    },
    error: function () {
      console.log('Error occurred during AJAX request')
    },
  })
})
