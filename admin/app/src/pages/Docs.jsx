import React, { useState, useRef } from "react";
import ReactMarkdown from "react-markdown";
import { BlockEditorProvider, BlockList, BlockTools, WritingFlow } from "@wordpress/block-editor";
import "@wordpress/components/build-style/style.css";
import "@wordpress/block-editor/build-style/style.css";
import { registerCoreBlocks } from "@wordpress/block-library";
import styles from "./Docs.module.scss";

/**
 * @resources
 * wp data layer: https://fullstackdigital.io/blog/building-react-powered-plugins-with-the-wordpress-data-layer/
 * block editor: https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/
 */

export default function Docs() {
  // registerCoreBlocks();
  const markdown = `
  # This is a header
  \n
  This is a paragraph
  \n
  `;
  const [inputContent, setInputContent] = useState(markdown);
  const content = useRef(markdown);

  const handleContentChange = (event) => {
    setInputContent(event.target.value);
  };

  return (
    <div className="container widgets-row">
      <div className="col-6">
        <textarea
          className={styles.textarea}
          name=""
          id=""
          cols="30"
          rows="10"
          ref={content}
          onChange={handleContentChange}></textarea>
      </div>
      <div className="col-6">
        <ReactMarkdown>{inputContent}</ReactMarkdown>
      </div>
    </div>
  );
}
