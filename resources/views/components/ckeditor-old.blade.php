<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap');

@media print {
    body {
        margin: 0 !important;
    }
}

:root {
    --ck-content-font-family: Lato;
    --ck-sidebar-width: 270px;
}

.main-container {
    font-family: var(--ck-content-font-family);
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.main-container .presence {
    margin-bottom: 8px;
}

.editor-container__editor-wrapper {
    display: flex;
    width: fit-content;
}

.editor-container_include-annotations .editor-container__editor .ck.ck-editor__editable {
    margin-right: 0;
}

.editor-container_classic-editor .editor-container__editor {
    min-width: 795px;
    max-width: 795px;
}

.editor-container__sidebar {
    min-width: var(--ck-sidebar-width);
    max-width: var(--ck-sidebar-width);
    margin-top: 28px;
    margin-left: 10px;
    margin-right: 10px;
}

.revision-history {
    display: none;
}

.revision-history__wrapper {
    display: flex;
}

.revision-history__wrapper .ck.ck-editor {
    margin: 0;
    width: 795px;
}

.revision-history__wrapper .revision-history__sidebar {
    border: 1px solid var(--ck-color-base-border);
    border-left: 0;
    width: var(--ck-sidebar-width);
    min-height: 100%;
}

.revision-history__wrapper .revision-history__sidebar .ck-revision-history-sidebar {
    height: 100%;
}

.editor_container__word-count .ck-word-count {
    color: var(--ck-color-text);
    display: flex;
    height: 20px;
    gap: var(--ck-spacing-small);
    justify-content: flex-end;
    font-size: var(--ck-font-size-base);
    line-height: var(--ck-line-height-base);
    font-family: var(--ck-font-face);
    padding: var(--ck-spacing-small) var(--ck-spacing-standard);
}

.editor-container_include-word-count.editor-container_classic-editor .editor_container__word-count {
    border: 1px solid var(--ck-color-base-border);
    border-radius: var(--ck-border-radius);
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-top: none;
}

.editor-container_include-word-count.editor-container_classic-editor .editor-container__editor .ck-editor .ck-editor__editable {
    border-radius: 0;
}
</style>

<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/48.5.1/ckeditor5.css" crossorigin>
<!-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/48.5.1/ckeditor5-premium-features.css" -->
crossorigin>


<script src="https://cdn.ckeditor.com/ckeditor5/48.5.1/ckeditor5.umd.js" crossorigin></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5-premium-features/48.5.1/ckeditor5-premium-features.umd.js" crossorigin> -->
</script>
<script src="https://cdn.ckbox.io/ckbox/2.13.1/ckbox.js" crossorigin></script>
<script>
const {
    ClassicEditor,
    Autosave,
    Essentials,
    Paragraph,
    Alignment,
    AutoImage,
    Autoformat,
    AutoLink,
    ImageBlock,
    BlockQuote,
    Bold,
    Bookmark,
    CKBox,
    CKBoxImageEdit,
    CloudServices,
    Code,
    CodeBlock,
    Emoji,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Fullscreen,
    GeneralHtmlSupport,
    Heading,
    Highlight,
    HorizontalLine,
    HtmlEmbed,
    ImageCaption,
    ImageEditing,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    ImageUtils,
    ImageInline,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    MediaEmbed,
    Mention,
    PageBreak,
    PasteFromOffice,
    PictureEditing,
    PlainTableOutput,
    RemoveFormat,
    ShowBlocks,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Subscript,
    Superscript,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableLayout,
    TableProperties,
    TableToolbar,
    TextPartLanguage,
    TextTransformation,
    TodoList,
    Underline,
    WordCount,
    BalloonToolbar
} = window.CKEDITOR;


/* 
const {
    getEmailInlineStylesTransformations,
    AIChat,
    AIEditorIntegration,
    AIQuickActions,
    AIReviewMode,
    CaseChange,
    Comments,
    ExportPdf,
    ExportWord,
    ExportInlineStyles,
    // Footnotes,
    // FormatPainter,
    // ImportWord,
    // LineHeight,
    // MergeFields,
    // MultiLevelList,
    // PasteFromOfficeEnhanced,
    // PresenceList,
    RealTimeCollaborativeComments,
    RealTimeCollaborativeEditing,
    RealTimeCollaborativeRevisionHistory,
    RealTimeCollaborativeTrackChanges,
    RevisionHistory,
    SlashCommand,
    TableOfContents,
    Template,
    TrackChanges,
    TrackChangesData,
    TrackChangesPreview
} = window.CKEDITOR_PREMIUM_FEATURES; 
 */

// const LICENSE_KEY = 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3OTQ0NDE1OTksImp0aSI6ImRmMGJhNTc0LTIyZjItNDU2Mi1hODZkLWZlYjRlMDM0Y2Y4MCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjY5ZWE0NDYwIn0.BDnbfOE3SNET2SzhwGOPFVmtFf7kpY4BgnulNYN55c9dCEsne08bLnsgMHfmAql4Bnf_9IZ73OSFDCPg8CuNPA';
const LICENSE_KEY =
    'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE4MjQ3Njc5OTksImp0aSI6ImM4ODZiYmZkLTkxNmQtNGRjZC1iM2Y4LTY5NTA0MDAzNzRlNSIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIiwiRTJQIiwiRTJXIl0sInJlbW92ZUZlYXR1cmVzIjpbIlBCIiwiUkYiLCJTQ0giLCJUQ1AiLCJUTCIsIlRDUiIsIklSIiwiU1VBIiwiQjY0QSIsIkxQIiwiSEUiLCJSRUQiLCJQRk8iLCJXQyIsIkZBUiIsIkJLTSIsIkZQSCIsIk1SRSIsIk1FUiJdLCJ2YyI6IjM3OWRkYTQ1In0.-0p9GLBxoduBn7pxVoECIwj69XPXXtJGx93FtJCJ-mD4JF4pBxC96hiTHTrW2aQgk5agKasdxHnpb6i9WjSLbg';

/**
 * Unique ID that will be used to identify this document. E.g. you may use ID taken from your database.
 * Read more: https://ckeditor.com/docs/ckeditor5/latest/api/module_collaboration-core_config-RealTimeCollaborationConfig.html
 */
const DOCUMENT_ID = '<YOUR_DOCUMENT_ID>';

const CLOUD_SERVICES_TOKEN_URL =
    'https://r3e4kfhs38bt.cke-cs.com/token/dev/bd38284612971a9296f2673da0521419234f28137627c8e648ab7373281b?limit=10';
const CLOUD_SERVICES_WEBSOCKET_URL = 'wss://r3e4kfhs38bt.cke-cs.com/ws';

const editorConfig = {

    toolbar: {
        items: [

            'heading',
            '|',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'removeFormat',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            'outdent',
            'indent',
            '|',
            'link',
            'insertTable',
            'blockQuote',
            'horizontalLine',
            'specialCharacters',
            '|',
            'imageUpload',
            'mediaEmbed',
            '|',
            'findAndReplace',
            'code',
            'codeBlock'
        ],
        shouldNotGroupWhenFull: true
    },

    plugins: [
        Essentials,
        Paragraph,
        Heading,
        Bold,
        Italic,
        Underline,
        Strikethrough,
        RemoveFormat,
        FontFamily,
        FontSize,
        FontColor,
        FontBackgroundColor,
        Alignment,
        List,
        ListProperties,
        Indent,
        IndentBlock,
        Link,
        AutoLink,
        BlockQuote,
        HorizontalLine,
        SpecialCharacters,
        FindAndReplace,
        Table,
        TableToolbar,
        TableProperties,
        TableCellProperties,
        Image,
        ImageToolbar,
        ImageCaption,
        ImageResize,
        ImageStyle,
        ImageInsert,
        ImageUpload,
        MediaEmbed,
        Code,
        CodeBlock,
    ],

    heading: {
        options: [{
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
            },
            {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
            },
            {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
            },
            {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
            }
        ]
    },

    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableProperties',
            'tableCellProperties'
        ]
    },

    image: {
        toolbar: [
            'imageTextAlternative',
            '|',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            '|',
            'resizeImage'
        ]
    },

    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://'
    },

    placeholder: 'Start writing document...'

};
configUpdateAlert(editorConfig);

ClassicEditor.create(document.querySelector('#editor'), editorConfig).then(editor => {
    const wordCount = editor.plugins.get('WordCount');
    document.querySelector('#editor-word-count').appendChild(wordCount.wordCountContainer);

    return editor;
});

/**
 * This function exists to remind you to update the config needed for premium features.
 * The function can be safely removed. Make sure to also remove call to this function when doing so.
 */
function configUpdateAlert(config) {
    if (configUpdateAlert.configUpdateAlertShown) {
        return;
    }

    const isModifiedByUser = (currentValue, forbiddenValue) => {
        if (currentValue === forbiddenValue) {
            return false;
        }

        if (currentValue === undefined) {
            return false;
        }

        return true;
    };

    const valuesToUpdate = [];

    configUpdateAlert.configUpdateAlertShown = true;

    if (!isModifiedByUser(config.licenseKey, '<YOUR_LICENSE_KEY>')) {
        valuesToUpdate.push(LICENSE_KEY);
    }

    if (!isModifiedByUser(config.cloudServices?.tokenUrl, CLOUD_SERVICES_TOKEN_URL)) {
        valuesToUpdate.push(CLOUD_SERVICES_TOKEN_URL);
    }

    if (!isModifiedByUser(config.cloudServices?.webSocketUrl, '<YOUR_CLOUD_SERVICES_WEBSOCKET_URL>')) {
        valuesToUpdate.push(CLOUD_SERVICES_WEBSOCKET_URL);
    }

    if (valuesToUpdate.length) {
        window.alert(
            [
                'Please update the following values in your editor config',
                'to receive full access to Premium Features:',
                '',
                ...valuesToUpdate.map(value => ` - ${value}`)
            ].join('\n')
        );
    }
}
</script>