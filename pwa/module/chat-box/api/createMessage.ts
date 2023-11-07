import clientHttp, {type ApiSchemas} from "~/module/shared/clientHttp";

export type MessageCreate = ApiSchemas['ChatBox.jsonld-chat-box.write']

export default function createMessage(messageCreate: MessageCreate) {
    return clientHttp.path('/chat_boxes').method('post').create()(messageCreate)
}
