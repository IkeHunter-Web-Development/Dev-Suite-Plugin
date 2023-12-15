import React from "react";
import styles from "./Welcome.module.scss";

export default function Welcome() {
  return (
    <div className="row">
      <div className={styles.welcome}>
        <h1 className={styles.welcome__title + ' heading-2'}>Good Afternoon!</h1>
        <p>Use the menu on the left to navigate to the various tools.</p> 
      </div>
    </div>
  );
}
