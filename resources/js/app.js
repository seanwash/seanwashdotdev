// require('./bootstrap');

import Alpine from "alpinejs"
import { Editor } from "@tiptap/core"
import StarterKit from "@tiptap/starter-kit"

window.setupEditor = function (content) {
    return {
        editor: null,
        content: content,
        updatedAt: Date.now(), // force Alpine to rerender on selection change
        init(element) {
            this.editor = new Editor({
                element: element,
                editorProps: {
                    attributes: {
                        class: "prose prose-sm sm:prose m-5 focus:outline-none",
                    },
                },
                extensions: [
                    StarterKit,
                ],
                content: this.content,
                onUpdate: ({ editor }) => {
                    this.content = editor.getHTML()
                },
                onSelectionUpdate: () => {
                    this.updatedAt = Date.now()
                },
            })
        },
    }
}

window.Alpine = Alpine
Alpine.start()
