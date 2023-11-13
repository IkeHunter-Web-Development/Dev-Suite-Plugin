import React from 'react'
import ReactMarkdown from 'react-markdown';

export default function Docs() {
  const markdown = `
  # This is a header
  \n
  This is a paragraph
  \n
  `
  
  return (
    <ReactMarkdown>
      {markdown}
    </ReactMarkdown>
  )
}
