import 'cropperjs/dist/cropper.css';
import Cropper from 'cropperjs';

let cropper;

const cropperSection = document.getElementById('cropper-section');
const cropperImage = document.getElementById('cropper-image');

const avatarCropperConfig = {
  viewMode: 1, //restrict the crop box not to exceed the size of the canvas
  dragMode: 'move',
  aspectRatio: 1,
  minContainerWidth: 288,
  minContainerHeight: 288,
};

const coverCropperConfig = {
  viewMode: 1, //restrict the crop box not to exceed the size of the canvas
  dragMode: 'move',
  minContainerWidth: 288,
  minContainerHeight: 432,
  aspectRatio: 288 / 432,
};

function openCropper(event, type) {
  const files = event.target.files;

  if (files && files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      cropperImage.src = e.target.result;

      if (cropper) {
        cropper.destroy();
      }

      if (type === 'avatar') {
        cropper = new Cropper(cropperImage, avatarCropperConfig);
      } else if (type === 'cover') {
        cropper = new Cropper(cropperImage, coverCropperConfig);
      } else {
        alert('Incorrect config for cropper! Call developers!');
      }

      // Display cropper. Send an event
      cropperSection.dispatchEvent(new Event('show-cropper'));
    };
    reader.readAsDataURL(files[0]);
  }
}

// This function places cropped image into input, which is sent by form
function cropAndSubmit(formId, inputId) {
  if (cropper) {
    cropper.getCroppedCanvas().toBlob((blob) => {
      const form = document.getElementById(formId);
      const fileInput = document.getElementById(inputId);

      const dataTransfer = new DataTransfer(); // Create a new DataTransfer object
      const croppedFile = new File([blob], 'cropped-avatar.png', { type: 'image/png' });
      dataTransfer.items.add(croppedFile);

      fileInput.files = dataTransfer.files; // Assign the new files to the input

      // Submit the form
      form.submit();
    }, 'image/png');
  }
}

// This function places cropped image into input, and into image
function cropAndSet(imgId, inputId) {
  if (cropper) {
    cropper.getCroppedCanvas().toBlob((blob) => {
      const imgElement = document.getElementById(imgId);
      const url = URL.createObjectURL(blob);
      imgElement.src = url;

      const fileInput = document.getElementById(inputId);
      const dataTransfer = new DataTransfer(); // Create a new DataTransfer object
      const croppedFile = new File([blob], 'cropped-avatar.png', { type: 'image/png' });
      dataTransfer.items.add(croppedFile);

      fileInput.files = dataTransfer.files; // Assign the new files to the input

      // Close cropper. Send an event
      cropperSection.dispatchEvent(new Event('close-cropper'));
    }, 'image/png');
  }
}

window.openCropper = openCropper;
window.cropAndSubmit = cropAndSubmit;
window.cropAndSet = cropAndSet;
