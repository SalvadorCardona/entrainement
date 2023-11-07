import clientHttp, {type ApiSchemas} from "~/module/shared/clientHttp";

export type MessageRead = ApiSchemas['ChatBox.jsonld-chat-box.read']

export default function getMessages() {
    return clientHttp.path('/chat_boxes').method('get').create()({})
}
