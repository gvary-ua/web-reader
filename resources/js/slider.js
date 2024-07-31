import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const swiper1 = new Swiper('.swiper1', {
  modules: [Navigation, Pagination],
  slidesPerView: 'auto',
  spaceBetween: 30,
  rewind: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

const swiper2 = new Swiper('.swiper2', {
  modules: [Navigation, Pagination],
  slidesPerView: 'auto',
  spaceBetween: 30,
  rewind: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

window.swiper1 = swiper1;
window.swiper2 = swiper2;
