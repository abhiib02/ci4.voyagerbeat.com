<style>

.review-cards-carousel{
  position:relative;
   perspective:150vw;
  perspective-origin:center;
  & .review-card{
    transform-style:preserve-3d;
    background:#00000055;
    color:#fff;
    position:absolute;
    top:50%;
    left:50%;
    translate:-50% -50%;
    filter:drop-shadow(0px 0px 5px #000);
    padding:1rem;
    transition:all .3s ease;
    opacity:0;
    width: 350px;
    &:after{
      position:absolute;
      bottom:0;
      left:0;
      content:'';
      background:var(--maincolor);
      width:100%;
      height:2px;
      scale:0 1;
    }
  }
}


.review-card:has(+.review-card +.review-card-active) {
 transform:translateY(250px) rotatex(60deg);
  opacity:0;
  scale:1;
  z-index:1;
}
.review-card:has(+.review-card-active) {
 transform:translateY(180px) rotatex(30deg);
  opacity:1;
  scale:1;
  z-index:1;
}
.review-card-active{
  opacity:1 !important;
  scale:1.1;
  z-index:2;
  &:after{
    animation:timerWidth 3s linear;  
  }
  
}
.review-card-active +.review-card{
 transform:translateY(-180px) rotatex(-30deg);
  opacity:1;
  scale:1;
  z-index:1;
}
.review-card-active +.review-card +.review-card{
 transform:translateY(-250px) rotatex(-60deg);
  opacity:0;
  scale:1;
  z-index:1;
}

.star-review {
  font-size:1rem;
  background-image:linear-gradient(90deg, rgba(253,208,46,1) 0%, rgba(253,208,46,1) calc((var(--rating)*20)* 1%), rgba(131,131,131,1) calc((var(--rating)*20)* 1%), rgba(131,131,131,1) 100%);
    background-size: cover;
  background-repeat:no-repeat;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
@keyframes timerWidth{
  0%{
    scale:0 1;
  }
  100%{
    scale:1 1;
  }
}

    </style>
    
<div class="review-cards-carousel"></div>

<script>
    const reviews = [
        {
            name:'Jyoti Parmar',
            reviewText:'The trip manager vaibhav sethi manages a great trip of kasol. My family enjoyed a lot.। I love the hotel stays and camps also ❤❤',
            rating:4.5,
            image:'https://voyagersbeat.com/assets/reviewer/1.png'
        },
        {
            name:'Jyoti Parmar',
            reviewText:'The trip manager vaibhav sethi manages a great trip of kasol. My family enjoyed a lot.। I love the hotel stays and camps also ❤❤',
            rating:3.9,
            image:'https://voyagersbeat.com/assets/reviewer/2.png'
        },
        {
            name:'Jyoti Parmar',
            reviewText:'The trip manager vaibhav sethi manages a great trip of kasol. My family enjoyed a lot.। I love the hotel stays and camps also ❤❤',
            rating:1.8,
            image:'https://voyagersbeat.com/assets/reviewer/3.png'
        },
        {
            name:'Jyoti Parmar',
            reviewText:'The trip manager vaibhav sethi manages a great trip of kasol. My family enjoyed a lot.। I love the hotel stays and camps also ❤❤',
            rating:4,
            image:'https://voyagersbeat.com/assets/reviewer/4.png'
        },
        {
            name:'Jyoti Parmar',
            reviewText:'The trip manager vaibhav sethi manages a great trip of kasol. My family enjoyed a lot.। I love the hotel stays and camps also ❤❤',
            rating:2.9,
            image:'https://voyagersbeat.com/assets/reviewer/5.png'
        },
        {
            name:'Jyoti Parmar',
            reviewText:'The trip manager vaibhav sethi manages a great trip of kasol. My family enjoyed a lot.। I love the hotel stays and camps also ❤❤',
            rating:1.9,
            image:'https://voyagersbeat.com/assets/reviewer/6.png'
        }];

(function ReviewsInit(){
        console.log('Reviews Init');
        let SlotContainer = document.querySelector('.review-cards-carousel');
        let HTMLString = ``;
        reviews.forEach((review,index)=>{
            HTMLString += `
            <div class="review-card ${(index == Math.floor(reviews.length/2)) ? 'review-card-active':''}" >
            <div class="d-flex">
                <img src="${review.image}" alt="${review.name}" class="rounded-circle" width="30" height="30">
                &nbsp;&nbsp;
                <h4>${review.name}</h4>
            </div>
                <span class="star-review" id="s1" style="--rating:${review.rating};">
                ★★★★★
                </span>
                <br>
                ${review.reviewText}
            </div>`;
        })
        SlotContainer.innerHTML = HTMLString;})();

  // Define functions for up and down
    function runUp(ele) {
        let Children = Array.from(ele.parentElement.children);
        let CurrentIndex = Children.findIndex(child => child.classList.contains("review-card-active"));
        
        if(CurrentIndex < (Children.length - 1)){
            ele.nextElementSibling.classList.add('review-card-active'); 
        }else{
        ele.parentElement.children[0].classList.add('review-card-active');     
        }
        
        //console.log(CurrentIndex,Children.length);
        return ;
    }

    function runDown(ele) {
        let Children = Array.from(ele.parentElement.children);
        let CurrentIndex = Children.findIndex(child => child.classList.contains("review-card-active"));
        
        if(CurrentIndex == 0){
            ele.parentElement.lastElementChild.classList.add('review-card-active');  
        }else{
            ele.previousElementSibling.classList.add('review-card-active');  
        }
        
        //console.log(CurrentIndex,Children.length);
        return;
    }
    setInterval(()=>{
        let currentActive = document.querySelector('.review-card-active');
        runDown(currentActive);
        currentActive.classList.remove('review-card-active');
      }, 3000);
      </script>