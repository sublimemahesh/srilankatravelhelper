<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>jQuery Read More/Less Toggle Example</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.3.15/slick.css" rel="stylesheet" type="text/css"/>
  <style>
      body, html {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  font-family: 'Helvetica', 'Arial', san-serif;
}

.slick-slide {
  height: 80vh;
  background: #2196f3;
  text-align: center;
  color: white;
  font-size: 20px;
  display: table !important;
}

.slick-slide div {
  display: table-cell;
  vertical-align: middle;
}

.slide-0 {
  background: red;
}

.slide-1 {
  background: orange;
}

.slide-2 {
  background: green;
}

.slide-3{
  background: black;
}

.hide {
  display: none;
}

.footer1 {
  height: 100px;
  color: white;
  background: blue;
}

.footer2 {
  height: 100px;
  color: white;
  background: green;
}

.footer-container {
  height: 100px;
  position: relative;
  text-align: center;
  font-size: 20px;
}

.footer-container div {
  padding: 2em;
}

.example-enter {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  opacity: 0.01;
}

.example-enter.example-enter-active {
  opacity: 1;
  transition: opacity .5s ease-in;
}
.example-leave {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  opacity: 1;
}

.example-leave.example-leave-active {
  opacity: 0.01;
  transition: opacity .5s ease-in;
}
  </style>

</head>

<body>

    <div id="root"></div>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.0/react-with-addons.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.0/react-dom.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-slick/0.13.1/react-slick.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-slick/0.13.1/react-slick.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    
    <script>
    const {
        CSSTransitionGroup
    } = React.addons;

    class Parent extends React.Component {
        constructor(props) {
            super(props);

            this.state = {
                selectedFooter: 1
            }

            this.settings = {
                dots: true,
                infinite: true,
                speed: 500,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                beforeChange: (prevIndex, nextIndex) => {
                    this.setState({
                        selectedFooter: [0, 1, 2].indexOf(nextIndex) !== -1 ? 1 : 2
                    });
                }
            };
        }

        render() {
            console.log('render');

            return (
                    <div>
  <SimpleSlider settings={this.settings} />
<Footer selectedFooter={this.state.selectedFooter} />
</div>
                    );
        }
    }

    class SimpleSlider extends React.Component {
        shouldComponentUpdate(nextProps) {
            // TODO: add proper implementation that compares objects
            return false;
        }

        render() {
            console.log('slider render');
            return (
                    <Slider {...this.props.settings}>
  <div><div className="slide-0"><h3>Graph 1</h3></div></div>
<div><div className="slide-1"><h3>Graph 2</h3></div></div>
  <div><div className="slide-2"><h3>Graph 3</h3></div></div>
    <div><div className="slide-3"><h3>Set Up</h3></div></div>
</Slider>
                    )
        }
    }

    const Footer = ({selectedFooter}) => {
        console.log('reander footer')
        return (
                <div className="footer-container">
    <CSSTransitionGroup
        transitionName="example"
        transitionEnterTimeout={500}
        transitionLeaveTimeout={500}>
        <div
            key={selectedFooter}
                className={`footer${selectedFooter}`}>
                Footer {selectedFooter}
        </div>
                </CSSTransitionGroup>
                </div>
                )
    }

    ReactDOM.render(<Parent />, document.querySelector('#root'));


  </script>


</body>

</html>
