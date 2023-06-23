{
  // Preloader page
  
  console.log(0)
  window.onload = function () {
    document.body.classList.add('loaded_hiding');
    console.log(1)
    window.setTimeout(function () {
      console.log(2)
      document.body.classList.add('loaded');
      document.body.classList.remove('loaded_hiding');
    }, 500);
  }
}

window.addEventListener('DOMContentLoaded', () => {
  try {
    // Slider games

    new Swiper(".swiper-popular", {
      slidesPerView: 7,
      spaceBetween: 57,
      loop: true,
      navigation: {
        nextEl: '.swiper__button_next',
        prevEl: '.swiper__button_left',
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        961: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 30,
        },
        1440: {
          slidesPerView: 5,
          spaceBetween: 40,
        },
        1600: {
          slidesPerView: 7,
        }
      }
    });
  } catch {}

  {
    // Hover effect

    const popularGames = document.querySelectorAll('.popular__item');

    popularGames.forEach((game) => {
      const gameButton = game.querySelector('.popular__game')
  
      game.addEventListener('mouseover', () => {
        gameButton.classList.remove('popular__hidden')
        gameButton.classList.add('popular__game_close')
        gameButton.classList.add('popular__game_hover')
  
        game.classList.add('popular__item_hover')
      })
  
      game.addEventListener('mouseout', () => {
        gameButton.classList.remove('popular__game_hover')
  
        game.classList.remove('popular__item_hover')
      })
    })
  }

  {
    // Mobile menu
    const hamburger = document.querySelector('[data-hamburger]');
    const menu = document.querySelector('[data-menu]');

    const toggleMenu = () => {
      hamburger.classList.toggle('hamburger_active')
      menu.classList.toggle('menu_active')

      if (menu.classList.contains('menu_active')) {
      document.body.style.overflow = 'hidden'
      } else {
      document.body.style.overflow = ''
      }
    }

    hamburger.addEventListener('click', toggleMenu)
  }

  {
    // Cookie

    const acceptCookie = document.querySelector('[data-cookie]')
    const cookieWrapper = document.querySelector('[data-cookie-wrapper]')

    acceptCookie.addEventListener('click', () => {
      localStorage.setItem('cookie', true)

      closeCookie(localStorage.getItem('cookie'))
    });

    const closeCookie = (cookie) => {
      cookie === 'true' ? cookieWrapper.classList.add('cookie_hidden') : ''
    }

    closeCookie(localStorage.getItem('cookie'))
  }
})