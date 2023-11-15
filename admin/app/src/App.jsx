import React from 'react'
import './App.scss';
import {BrowserRouter, HashRouter, Route, Router, Routes} from 'react-router-dom';
import Test from './pages/Test';
import Overview from './pages/Overview';
import Docs from './pages/Docs';

export default function App() {
    console.log('App')
    console.log('app again')
    return (
        // <BrowserRouter basename='/wp-admin/admin.php'>
        //   <Routes>
        //     <Route path="/" exact element={<Overview />} />
        //     <Route path="/#test" exact element={<Test />} />
        //   </Routes>
        // </BrowserRouter>
        <HashRouter>
            <Routes>
                <Route path="/" element={<Overview/>}/>
                <Route path="/test" element={<Test/>}/>
                <Route path="/docs" element={<Docs/>}/>
            </Routes>
        </HashRouter>
    )
}
