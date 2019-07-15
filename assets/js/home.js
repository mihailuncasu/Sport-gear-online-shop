// Master DOManipulator v2 ------------------------------------------------------------
const myItems = document.querySelectorAll('.myItem'),
  controls = document.querySelectorAll('.control'),
  headerItems = document.querySelectorAll('.myItem-header'),
  descriptionItems = document.querySelectorAll('.myItem-description'),
  activeDelay = .76,
  interval = 5000;

let current = 0;

const slider = {
  init: () => {
    controls.forEach(control => control.addEventListener('click', (e) => { slider.clickedControl(e) }));
    controls[current].classList.add('active');
    myItems[current].classList.add('active');
  },
  nextSlide: () => { // Increment current slide and add active class
    slider.reset();
    if (current === myItems.length - 1) current = -1; // Check if current slide is last in array
    current++;
    controls[current].classList.add('active');
    myItems[current].classList.add('active');
    slider.transitionDelay(headerItems);
    slider.transitionDelay(descriptionItems);
  },
  clickedControl: (e) => { // Add active class to clicked control and corresponding slide
    slider.reset();
    clearInterval(intervalF);

    const control = e.target,
      dataIndex = Number(control.dataset.index);

    control.classList.add('active');
    myItems.forEach((myItem, index) => { 
      if (index === dataIndex) { // Add active class to corresponding slide
        myItem.classList.add('active');
      }
    })
    current = dataIndex; // Update current slide
    slider.transitionDelay(headerItems);
    slider.transitionDelay(descriptionItems);
    intervalF = setInterval(slider.nextSlide, interval); // Fire that bad boi back up
  },
  reset: () => { // Remove active classes
    myItems.forEach(myItem => myItem.classList.remove('active'));
    controls.forEach(control => control.classList.remove('active'));
  },
  transitionDelay: (myItems) => { // Set incrementing css transition-delay for .myItem-header & .myItem-description, .vertical-part, b elements
    let seconds;
    
    myItems.forEach(myItem => {
      const children = myItem.childNodes; // .vertical-part(s)
      let count = 1,
        delay;
      
      myItem.classList.value === 'myItem-header' ? seconds = .015 : seconds = .007;

      children.forEach(child => { // iterate through .vertical-part(s) and style b element
        if (child.classList) {
          myItem.parentNode.classList.contains('active') ? delay = count * seconds + activeDelay : delay = count * seconds;
          child.firstElementChild.style.transitionDelay = `${delay}s`; // b element
          count++;
        }
      })
    })
  },
}

let intervalF = setInterval(slider.nextSlide, interval);
slider.init();