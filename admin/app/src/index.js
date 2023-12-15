import App from './App';
import {render} from '@wordpress/element';
import Welcome from './Welcome/Welcome';
import './styles/main.scss';

// const devSuiteWelcome = document.getElementById('dev-suite-welcome');
// const devSuiteAdmin = document.getElementById('development-suite-admin');
//
// if (devSuiteWelcome) render(<App/>, devSuiteWelcome);
// if (devSuiteAdmin) render(<App/>, devSuiteAdmin);

// render(<App/>, document.getElementById('dev-suite-welcome'));
// render(<App/>, document.getElementById('development-suite-admin'));

try {
    render(<Welcome/>, document.getElementById('dev-suite-welcome'));
} catch (error) {
    console.log(error);
}

try {
    render(<App/>, document.getElementById('development-suite-admin'));
} catch (error) {
    console.log(error);
}



